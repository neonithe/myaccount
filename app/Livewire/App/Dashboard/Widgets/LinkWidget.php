<?php

namespace App\Livewire\App\Dashboard\Widgets;

use App\Models\link\Cat;
use App\Models\link\Link;
use App\Models\link\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class LinkWidget extends Component
{
    use WithPagination;
    public $items = 5, $search, $filterType, $filterFav = false, $filterCat, $filterTag;


    /**  **/
    public function changeInputs($id, $input, $value) {
        $link = Link::findOrFail($id);
        if ($input != 'type') {
            $link->$input = $value;
        } else {
            switch ($value) {
                case 'folder_link': $link->folder_link = true; $link->app_link = false; $link->document_link = false;  break;
                case 'app_link': $link->folder_link = false; $link->app_link = true; $link->document_link = false;  break;
                case 'document_link': $link->folder_link = false; $link->app_link = false; $link->document_link = true;  break;
            }
        }
        $link->save();
    }

    public function setFav($id) {
        $link = Link::findOrFail($id);
        ($link->fav) ? $link->fav = false : $link->fav = true;
        $link->save();
    }


    /** Filter and search **/
    public function filterFavFunction() {
        ($this->filterFav) ? $this->filterFav = false : $this->filterFav = true;
    }

    public function handelSearch($query, $input, $search) {
        if ($search) {
            $query->where(function ($subquery) use ($input, $search) {
                $subquery->where($input, 'like', '%' . $search . '%');
            });
        }
        return $query;
    }

    public function render()
    {
        $links = $this->handelSearch(Link::where('user_id', Auth::id())->orderBy('fav', 'desc'), 'name', $this->search);

        if ($this->filterTag) {$links->where('tag_id', $this->filterTag);}
        if ($this->filterCat) {$links->where('cat_id', $this->filterCat);}
        if ($this->filterType) {$links->where($this->filterType, true);}
        if ($this->filterFav) {
            $links->where('fav', true);
        } else if($this->filterFav == false) {
            $links->where('fav', false);
        }

        return view('livewire.app.dashboard.widgets.link-widget',[
            'links'         =>  $links->paginate($this->items),
            'cats'          =>  Cat::where('user_id', Auth::id())->get(),
            'tags'          =>  Tag::where('user_id', Auth::id())->get(),
        ]);
    }
}
