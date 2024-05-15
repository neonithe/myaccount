<?php

namespace App\Livewire\App\Dashboard\Widgets;

use App\Models\workout\Exercises;
use App\Models\workout\Workout;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WorkoutWidget extends Component
{
    public $selectedWorkout, $workoutExercise, $exSelectedId;
    public $selectSet, $selectRep, $selectWeight;
    public $dayName;
    public $showWorkoutSlider = false;


    /** Get workout and exercise **************************************************************************************/
    public function showWorkout($id) {
        $this->showWorkoutSlider = true;
        $this->selectedWorkout = Workout::findOrFail($id);
        $this->workoutExercise = $this->selectedWorkout->exercise;
    }

    /** Add exercise to workout ***************************************************************************************/
    public function addExToWo() {
        $workout = Workout::find($this->selectedWorkout->id);

        if (!$workout->exercise()->wherePivot('exercises_id', $this->exSelectedId)->exists()) {
            if ($this->exSelectedId) {
                $workout->exercise()->attach($this->exSelectedId, [
                    'set'    => ($this->selectSet) ? $this->selectSet : 1 ,
                    'rep'    => ($this->selectRep) ? $this->selectRep : 1 ,
                    'weight' => ($this->selectWeight) ? $this->selectWeight : 0 ,
                ]);
                $this->dispatch('successmessage', 'Workout', 'Exercise successfully added.');
            } else {
                $this->dispatch('successmessage', 'Workout', 'You must choose exercise.', true);
            }
        } else {
            $this->dispatch('successmessage', 'Workout', 'Already have this exercise in workout.', true);
        }

        $this->showWorkout($workout->id);
        $this->render();
    }

    /** Change exercise ***********************************************************************************************/
    // Change data on pivot table
    public function changeData($workoutId, $exerciseId, $type, $value) {
        $workout = \App\Models\workout\Workout::find($workoutId);
        $workout->exercise()->updateExistingPivot($exerciseId, [
            $type => $value,
        ]);
        $this->showWorkout($workoutId);
    }

    /** Remove exercise from workout **********************************************************************************/
    public function removeExerciseFromWorkout($workoutId, $exerciseId) {
        $workout = \App\Models\workout\Workout::find($workoutId);
        if ($workout) {
            $workout->exercise()->detach($exerciseId);

            $this->showWorkout($workoutId);
            $this->dispatch('successmessage', 'Workout', 'Exercise removed from workout.');
        }
        $this->render();
    }

    public function changeWorkout($id) {

    }

    public function render()
    {
        $this->dayName  = Carbon::now()->locale('en')->isoFormat('dddd');

        return view('livewire.app.dashboard.widgets.workout-widget',[
            'exercises'     =>  Exercises::where('user_id', Auth::id())->get(),
            'workouts'      =>  Workout::where('user_id', Auth::id())->get(),
            'workoutDay'    =>  Workout::where('user_id', Auth::id())->where('day', $this->dayName)->get(),
        ]);
    }
}
