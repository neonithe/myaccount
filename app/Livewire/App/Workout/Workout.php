<?php

namespace App\Livewire\App\Workout;

use App\Models\workout\Exercises;
use App\Models\workout\WorkoutArea;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Workout extends Component
{
    public $exName, $exArea, $exLink;
    public $woName, $woDay;

    public $selectedWorkout, $exSelectedId, $workoutExercise, $selectSet, $selectRep, $selectWeight;

    public $workoutEditSearch, $workoutSearch, $exerciseSearch;
    public $workoutEditDayFilter = null, $workoutDayFilter = null, $exerciseEditAreaFilter = null;


    /** Get Workout ***************************************************************************************************/
    public function selectWorkout($id) {
        $this->selectedWorkout = \App\Models\workout\Workout::findOrFail($id);
        $this->workoutExercise = $this->selectedWorkout->exercise;
    }

    /** Create ********************************************************************************************************/
    public function exAdd() {
        $this->validate([
            'exName'    =>  'required',
            'exArea'    =>  'required',
        ]);

        Exercises::create([
            'user_id'   =>  Auth::id(),
            'exercise'  =>  $this->exName,
            'area_id'   =>  $this->exArea,
            'link'      =>  $this->exLink,
        ]);

        $this->dispatch('successmessage', 'Exercise', 'Exercise successfully created.');
    }

    public function woAdd() {
        $this->validate([
            'woName'    =>  'required',
            'woDay'     =>  'required',
        ]);

        \App\Models\workout\Workout::create([
            'user_id'       =>  Auth::id(),
            'workout_set'   =>  $this->woName,
            'day'           =>  $this->woDay,
        ]);

        $this->dispatch('successmessage', 'Workout', 'Workout successfully created.');
    }

    /** Edit **********************************************************************************************************/
    public function changeWorkout($id, $type, $value) {
        if ($value) {
            $data = \App\Models\workout\Workout::findOrFail($id);
            $data->$type = $value;
            $data->save();
            if ($type == 'workout_set') {
                $message = 'name';
            } else {
                $message = 'day';
            }
            $this->dispatch('successmessage', 'Workout', 'Workout '.$message.' successfully changed.');
        } else {
            $this->dispatch('successmessage', 'Workout - Error', 'Cannot leave empty.', true);
        }
    }

    public function changeExercise($id, $type, $value) {
        if ($value) {
            $data = Exercises::findOrFail($id);
            $data->$type = $value;
            $data->save();

            if ($type == 'exercise') { $message = 'name'; }
            if ($type == 'area_id') { $message = 'area'; }
            if ($type == 'link') { $message = 'link'; }

            $this->dispatch('successmessage', 'Exercise', 'Exercise '.$message.' successfully changed.');
        } else if ($type == 'link') {
            $data = Exercises::findOrFail($id);
            $data->link = null;
            $data->save();

            $this->dispatch('successmessage', 'Exercise', 'Exercise link successfully changed.');
        } else {
            $this->dispatch('successmessage', 'Exercise - Error', 'Cannot leave empty.', true);
        }

    }

    // Change data on pivot table
    public function changeData($workoutId, $exerciseId, $type, $value) {
        $workout = \App\Models\workout\Workout::find($workoutId);
        $workout->exercise()->updateExistingPivot($exerciseId, [
            $type => $value,
        ]);
        $this->selectWorkout($workoutId);
    }

    /** Edit **********************************************************************************************************/
    public function addExToWo() {
        $workout = \App\Models\workout\Workout::find($this->selectedWorkout->id);

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

        $this->selectWorkout($workout->id);
        $this->render();
    }

    /** Remove exercise from workout **********************************************************************************/
    public function removeExerciseFromWorkout($workoutId, $exerciseId) {
        $workout = \App\Models\workout\Workout::find($workoutId);
        if ($workout) {
            $workout->exercise()->detach($exerciseId);

            $this->selectWorkout($workoutId);
            $this->dispatch('successmessage', 'Workout', 'Exercise removed from workout.');
        }
        $this->render();
    }

    /** Delete ********************************************************************************************************/
    /** Workout **/
    public function deleteWorkout($id) {
        $workout = \App\Models\workout\Workout::with('exercise')->findOrFail($id);
        $workout->exercise()->detach();
        $workout->delete();
        $this->dispatch('successmessage', 'Workout', 'Workout successfully deleted.');
        $this->render();
    }

    /** Exercise **/
    public function deleteExercise($id) {
        $exercise = Exercises::findOrFail($id);

        if ($exercise->workouts()->exists()) {
            $this->dispatch('successmessage',
                'Cannot delete',
                'Cannot delete exercise because it is used in one or more workouts.',
                true
            );
            return;
        }

        $exercise->delete();
        $this->dispatch('successmessage', 'Exercise deleted successfully.');

        //$this->selectWorkout($workoutId);
    }

    /** Render - Filter - Search - Total Calc *************************************************************************/
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

        $exerciseList = null;

        // Total weight and reps
        $totWeight = 0; $totReps = 0;

        if ($this->selectedWorkout) {
            if ($this->workoutExercise->count() != 0) {
                foreach ($this->workoutExercise as $exercise) {
                    $pivot = $exercise->pivot;
                    $totReps += $pivot->rep * $pivot->set;
                    $totWeight += ($pivot->rep * $pivot->set) * $pivot->weight;
                }
            } else {
                $totWeight = 0; $totReps = 0;
            }
        }

        // Search
        $searchEditWorkoutQuery  = $this->handelSearch(\App\Models\workout\Workout::where('user_id', Auth::id()), 'workout_set', $this->workoutEditSearch);
        $searchWorkoutQuery      = $this->handelSearch(\App\Models\workout\Workout::where('user_id', Auth::id()), 'workout_set', $this->workoutSearch);
        $searchEditExerciseQuery = $this->handelSearch(Exercises::where('user_id', Auth::id()), 'exercise', $this->exerciseSearch);

        // Filter
        if ($this->workoutEditDayFilter) {$searchEditWorkoutQuery->where('day', $this->workoutEditDayFilter);}
        if ($this->workoutDayFilter) {$searchWorkoutQuery->where('day', $this->workoutDayFilter);}
        if ($this->exerciseEditAreaFilter) {$searchEditExerciseQuery->where('area_id', $this->exerciseEditAreaFilter);}

        return view('livewire.app.workout.workout',[

            'totReps'       => $totReps,
            'totWeight'     => $totWeight,
            'area'          => WorkoutArea::all(),
            'exercises'     => $searchEditExerciseQuery->get(),
            'workouts'      => $searchEditWorkoutQuery->get(),
            'workoutsShow'  => $searchWorkoutQuery->get(),

        ])->layout('layouts.app');
    }
}
