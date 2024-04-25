<?php

namespace App\Livewire\App\Link\Link;

use App\Models\link\Cat;
use App\Models\link\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Link extends Component
{
    use Withpagination;

    public $name, $link, $link_2, $tag_id, $cat_id;
    public $catName, $tagName;
    public $fav, $app = true, $doc = false, $fold = false;

    public $search, $searchCat, $searchTag, $filterCat, $filterTag, $filterType, $filterFav;

    public $showLinks = 20;


    /** Reset *********************************************************************************************************/
    public function resetAll() {
        $this->app = true; $this->doc = false; $this->fold = false;
        $this->name = null; $this->link = null; $this->link_2 = null; $this->tag_id = null;
        $this->catName = null; $this->tagName = null;
    }


    /** Set & Toggle **************************************************************************************************/
    public function setType($type) {
        switch ($type) {
            case 'app': $this->app = true; $this->doc = false; $this->fold = false; break;
            case 'doc': $this->app = false; $this->doc = true; $this->fold = false; break;
            case 'fold': $this->app = false; $this->doc = false; $this->fold = true; break;
        }
    }

    public function setFav() {
        ($this->fav) ? $this->fav = false : $this->fav = true;
    }

    public function toggleFav($id) {
        $data = \App\Models\link\Link::where('user_id', Auth::id())->findOrFail($id);
        ($data->fav) ? $data->fav = false : $data->fav = true;
        $data->save();
    }

    /** Create ********************************************************************************************************/

    public function saveLink() {
        $this->validate([
            'name'  =>  'required',
            'link'  =>  'required',
            'cat_id'=>  'required',
        ]);

        \App\Models\link\Link::create([
            'user_id'       =>  Auth::id(),
            'name'          =>  $this->name,
            'link'          =>  $this->link,
            'link_2'        =>  $this->link_2,
            'tag_id'        =>  $this->tag_id,
            'cat_id'        =>  $this->cat_id,
            'folder_link'   =>  $this->fold,
            'document_link' =>  $this->doc,
            'app_link'      =>  $this->app,
            'fav'           =>  $this->fav,
        ]);

        $this->resetAll();
        $this->dispatch('successmessage', 'Links', $this->name.' is added successfully.');
    }

    /** Edit **********************************************************************************************************/
    public function changeLink($id, $type, $value, $change) {
        $data = \App\Models\link\Link::findOrFail($id);
        $data->$type = $value;
        $data->save();
        $this->dispatch('successmessage', 'Links', $change.' is now changed.' );
    }

    public function changeType($id, $type, $change) {
        $data = \App\Models\link\Link::findOrFail($id);
        switch ($type) {
            case 'app_link': $data->app_link = true; $data->folder_link = false; $data->document_link = false; break;
            case 'folder_link': $data->app_link = false; $data->folder_link = true; $data->document_link = false; break;
            case 'document_link': $data->app_link = false; $data->folder_link = false; $data->document_link = true; break;
        }
        $data->save();
        $this->dispatch('successmessage', 'Links', $change.' is now changed.' );
    }

    /** Delete ********************************************************************************************************/
    public function deleteLink($id) {
        $data = \App\Models\link\Link::findOrFail($id);
        $name = $data->name;
        $data->delete();
        $this->dispatch('successmessage', 'Link', $name.' is now deleted.' );
        $this->render();
    }

    /** Categories ****************************************************************************************************/
    public function addCat() {
        $this->validate([
            'catName'  =>  'required',
        ]);

        Cat::create([
            'user_id'       =>  Auth::id(),
            'name'          =>  $this->catName,
        ]);

        $this->resetAll();
        $this->dispatch('successmessage', 'Category', $this->catName.' is added successfully.');
    }

    public function changeCat($id, $type, $value, $change) {
        $data = Cat::findOrFail($id);
        $data->$type = $value;
        $data->save();
        $this->dispatch('successmessage', 'Category', $change.' is now changed.' );
    }

    public function deleteCat($id) {
        $data = Cat::findOrFail($id);
        $name = $data->name;
        $linkCount = \App\Models\Link\Link::where('cat_id', $id)->count();
        if ($linkCount != 0) {
            $this->dispatch('successmessage', 'Category', $data->name.' is connected to one or more links. Disconnect category on links then you can remove category.', true );
        } else {
            $data->delete();
            $this->dispatch('successmessage', 'Category', $name.' is now deleted.' );
        }
        $this->render();
    }

    /** Tags **********************************************************************************************************/
    public function addTag() {
        $this->validate([
            'tagName'  =>  'required',
        ]);

        Tag::create([
            'user_id'       =>  Auth::id(),
            'name'          =>  $this->tagName,
        ]);

        $this->resetAll();
        $this->dispatch('successmessage', 'Tag', $this->tagName.' is added successfully.');
    }

    public function changeTag($id, $type, $value, $change) {
        $data = Tag::findOrFail($id);
        $data->$type = $value;
        $data->save();
        $this->dispatch('successmessage', 'Tag', $change.' is now changed.' );
    }

    public function deleteTag($id) {
        $data = Tag::findOrFail($id);
        $name = $data->name;
        $linkCount = \App\Models\Link\Link::where('cat_id', $id)->count();
        if ($linkCount != 0) {
            $this->dispatch('successmessage', 'Tag', $data->name.' is connected to one or more links. Disconnect category on links then you can remove category.', true );
        } else {
            $data->delete();
            $this->dispatch('successmessage', 'Tag', $name.' is now deleted.' );
        }
        $this->render();
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
        $links = $this->handelSearch(\App\Models\link\Link::where('user_id', Auth::id())->orderBy('fav', 'desc'), 'name', $this->search);
        $cats  = $this->handelSearch(Cat::where('user_id', Auth::id()), 'name', $this->searchCat);
        $tags  = $this->handelSearch(Tag::where('user_id', Auth::id()), 'name', $this->searchTag);

        if ($this->filterTag) {$links->where('tag_id', $this->filterTag);}
        if ($this->filterCat) {$links->where('cat_id', $this->filterCat);}
        if ($this->filterType) {$links->where($this->filterType, true);}
        if ($this->filterFav == 'fav') {
            $links->where('fav', true);
        } else if($this->filterFav == 'nofav') {
            $links->where('fav', false);
        }

        return view('livewire.app.link.link.link',[
                'listTag'   =>  $tags->get(),
                'listCat'   =>  $cats->get(),
                'links'     =>  $links->paginate($this->showLinks),
                'tags'      =>  Tag::where('user_id', Auth::id())->get(),
                'cats'      =>  Cat::where('user_id', Auth::id())->get(),
        ])->layout('layouts.app');
    }
}
