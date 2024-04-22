<?php

namespace App\Livewire\App\Food;

use App\Models\recipe\Ingredient;
use App\Models\recipe\Recipe;
use App\Models\todo\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Food extends Component
{
    use WithPagination;

    public $ingredientName, $fat, $sugar, $carb, $salt, $protein, $cal;

    public $name, $link, $description, $recipePortion;
    public $ingredients = [];

    public $newIngredient, $newVolume, $newType, $newGram;
    public $getIngredientsList = null, $getRecipe = null;

    public $fatCal = 0, $sugarCal = 0, $carbCal = 0, $saltCal = 0, $proteinCal = 0, $calCal = 0;

    public $portion = 4;

    /** Reset Recipe **************************************************************************************************/
    public function resetRecipe() {
        $this->getRecipe = null;
    }

    /** Recipe ***************************************************************************************************/
    public function addIngredientToRecipe()
    {
        $this->ingredients[] = ['id' => '', 'volume' => '', 'type' => '', 'gram' => ''];
    }

    public function removeIngredient($index)
    {
        unset($this->ingredients[$index]);
        $this->ingredients = array_values($this->ingredients);
    }

    public function saveRecipe()
    {
        // $name, $link, $description, $recipePortion;
        $this->validate([
            'name'      =>  'required',
            'portion'   =>  'required',
        ]);

        $recipe = Recipe::create([
            'user_id'       => Auth::id(),
            'name'          => $this->name,
            'link'          => $this->link,
            'description'   => $this->description,
            'portion'       => $this->recipePortion,
        ]);

        foreach ($this->ingredients as $ingredient) {
            $recipe->ingredients()->attach($ingredient['id'], [
                'volume'    => $ingredient['volume'],
                'type_name' => $ingredient['type'],
                'gram'      => ($ingredient['gram'] >= 0) ? $ingredient['gram'] : 0,
            ]);
        }

        $this->reset('name', 'description', 'ingredients');
        $this->dispatch('successmessage', 'Recipe created successfully.');
    }

    public function deleteRecipe($id) {
        $recipe = Recipe::with('ingredients')->findOrFail($id);

        // Detach alla ingredienser från detta recept först
        $recipe->ingredients()->detach();

        // Ta sedan bort receptet
        $recipe->delete();

        // Sänd ett framgångsmeddelande och omdirigera användaren, eller uppdatera listan
        $this->dispatch('successmessage', 'Recipe deleted successfully.');
        $this->render();
    }

    /** Show recipe ***************************************************************************************************/
    public function getIngredients($id) {
        $data = Recipe::findOrFail($id);
        $this->getIngredientsList = $data->ingredients;
        $this->getRecipe = $data;
        $this->calculateData();
    }

    public function removeIngredientFromRecipe($recipeId, $ingredientId)
    {
        $recipe = Recipe::find($recipeId);
        if ($recipe) {
            $recipe->ingredients()->detach($ingredientId);
            // Uppdatera ingredienslistan efter borttagningen
            $this->getIngredients($recipeId);
            $this->dispatch('successmessage', 'Ingredient removed from recipe successfully.');
        }
    }

    public function addNewIngredientToRecipe() {
        $recipe = Recipe::findOrFail($this->getRecipe->id); // Hämta det aktuella receptet
        $recipe->ingredients()->attach($this->newIngredient, [
            'volume'    => $this->newVolume,
            'type_name' => $this->newType,
            'gram'      => $this->newGram,
        ]);

        $this->reset('newIngredient', 'newVolume', 'newType', 'newGram');
        // Uppdatera ingredienslistan efter borttagningen
        $this->getIngredients($this->getRecipe->id);
        $this->dispatch('successmessage', 'Ingredient added to recipe successfully.');
    }

    /** Change Recipe *************************************************************************************************/
    public function changeData($recipeId, $ingId, $type, $input) {
        $recipe = Recipe::find($recipeId);
        $recipe->ingredients()->updateExistingPivot($ingId, [
            $type => $input,
        ]);
        $this->getIngredients($recipeId);
        $this->calculateData();
        $this->dispatch('successmessage', 'Recipe updated');
    }

    public function changeRecipe($recipeId, $type, $input) {
        $recipe = Recipe::find($recipeId);
        $recipe->$type = $input;
        $recipe->save();
        $this->getIngredients($recipeId);
        $this->dispatch('successmessage', 'Recipe updated');
    }

    /** Ingredient ****************************************************************************************************/
    public function addIngredient() {

        $this->validate([
            'ingredientName' => 'required'
        ]);

        if (Ingredient::where('user_id', Auth::id())->where('name', $this->ingredientName)->count() == 0) {
            Ingredient::create([
                'user_id'   => Auth::id(),
                'name'      => $this->ingredientName,
                'fat'       => $this->fat/100,
                'calories'  => $this->cal/100,
                'carbs'     => $this->carb/100,
                'salt'      => $this->salt/100,
                'protein'   => $this->protein/100,
                'sugars'    => $this->sugar/100,
            ]);
            $this->reset('ingredientName', 'fat', 'cal', 'carb', 'salt', 'protein', 'sugar');
            $this->dispatch('successmessage', 'Ingredient','Ingredient added successfully.');
        } else {
            $this->dispatch('successmessage', 'Ingredient', $this->ingredientName.': This name already in use',true);
        }

    }

    public function deleteIngredient($id) {

        $ingredient = Ingredient::findOrFail($id);

        // Kontrollera om ingrediensen används i något recept.
        if ($ingredient->recipes()->exists()) {

            // Ingrediensen är kopplad till recept. Hantera detta fall, exempelvis:
            $this->dispatch('successmessage',
                'Cannot delete',
                'Cannot delete ingredient because it is used in one or more recipes.',
                true
            );
            return; // Avslutar metoden här så ingrediensen tas inte bort.
        }

        // Om ingrediensen inte används i något recept, ta bort den.
        $ingredient->delete();
        $this->dispatch('successmessage', 'Ingredient deleted successfully.');

        if ($this->getRecipe) {
            $this->getIngredients($this->getRecipe->id);
        }
    }

    public function changeIngredient($id, $type ,$value) {
        $data = Ingredient::findOrFail($id);
        $data->$type = $value/100;
        $data->save();
        $this->dispatch('successmessage', 'Ingredient - '.$type, 'Data successfully changed.');
        $this->render();
    }

    /** Calculations **************************************************************************************************/
    public function getIngredientData($id, $type) {
        $data = Ingredient::findOrFail($id);
        switch ($type) {
            case 'fat': return $data->fat;
            case 'cal': return $data->calories;
            case 'car': return $data->carbs;
            case 'sug': return $data->sugars;
            case 'pro': return $data->protein;
            case 'sal': return $data->salt;
        }
    }

    public function calculateData() {
        $this->fatCal = 0; $this->sugarCal = 0; $this->carbCal = 0; $this->saltCal = 0; $this->proteinCal = 0; $this->calCal = 0;
        foreach ($this->getIngredientsList as $item) {
            $this->fatCal += ($this->getIngredientData($item->pivot->ingredient_id, 'fat') * $item->pivot->gram);
            $this->sugarCal += ($this->getIngredientData($item->pivot->ingredient_id, 'sug') * $item->pivot->gram);
            $this->carbCal += ($this->getIngredientData($item->pivot->ingredient_id, 'car') * $item->pivot->gram);
            $this->saltCal += ($this->getIngredientData($item->pivot->ingredient_id, 'sal') * $item->pivot->gram);
            $this->proteinCal += ($this->getIngredientData($item->pivot->ingredient_id, 'pro') * $item->pivot->gram);
            $this->calCal += ($this->getIngredientData($item->pivot->ingredient_id, 'cal') * $item->pivot->gram);
        }
    }

    public function changePortion($value) {

        if ($this->getRecipe) {
            $this->getRecipe->portion = $value;
            $this->getRecipe->save();
            $this->getIngredients($this->getRecipe->id);
        }
    }

    /** Add to MyTodo *************************************************************************************************/
    public function addFoodToTodo() {
        $recipe = Recipe::findOrFail($this->getRecipe->id);
        $ingredients = $recipe->ingredients;
        $description = '';

        foreach ($ingredients as $item) {
            $description .= $item->name . ", Volume: " . $item->pivot->volume . " " . $item->pivot->type_name . "\n";
        }

        Todo::create([
            'user_id'   =>  Auth::id(),
            'todo'          =>  'Inköp av matvaror för: '.$this->getRecipe->name,
            'notice'        =>  true,
            'link'          =>  ($this->getRecipe->link != null) ? $this->getRecipe->link : null,
            'comment'       =>  $description,

        ]);

        $this->dispatch('successmessage', 'Recipe', 'Foodtype added to todo to buy!');
        $this->getIngredients($this->getRecipe->id);
    }

    public $search, $ingSearch;

    public function render()
    {
        $query = Recipe::where('user_id', Auth::id());
        $ingQuery = Ingredient::where('user_id', Auth::id());

        if ($this->search) {
            $query->where(function ($subquery) {
                $subquery->where('name', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->ingSearch) {
            $ingQuery->where(function ($subquery) {
                $subquery->where('name', 'like', '%' . $this->ingSearch . '%');
            });
        }

        return view('livewire.app.food.food', [
            'ingredientList'    => $ingQuery->paginate(20),
            'recipeList'        => $query->paginate(20),
        ])->layout('layouts.app');
    }
}
