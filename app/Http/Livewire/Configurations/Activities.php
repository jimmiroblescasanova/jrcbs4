<?php

namespace App\Http\Livewire\Configurations;

use App\Models\Activity;
use Livewire\Component;
use Livewire\WithPagination;

class Activities extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $activityId, $name;

    protected $rules = [
        'name' => ['required', 'string', 'min:5'],
    ];

    protected $listeners = ['deleteActivity'];

    public function clearVars()
    {
        $this->reset('name');
    }

    public function addActivity()
    {
        $activity = new Activity();

        $this->activityId = $activity->id;
        $this->name = $activity->name;

        $this->emit('addOrUpdateModal');
    }

    public function updateActivity(Activity $activity)
    {
        $this->activityId = $activity->id;
        $this->name = $activity->name;

        $this->emit('addOrUpdateModal');
    }

    public function saveActivity()
    {
        $this->validate();

        $data = [
            'name' => $this->name
        ];

        if ($this->activityId) {
            Activity::findOrFail($this->activityId)->update($data);
        } else {
            Activity::create($data);
        }

        $this->emit('hideModalTrigger');
        $this->clearVars();
    }

    public function deleteActivity($id)
    {
        $activity = Activity::findOrFail($id);

        if (!$activity->tickets()->exists()) {
            $activity->delete();
        } else {
            $this->emit('alert-error', [
                'title' => 'Error al eliminar',
                'message' => 'No se puede eliminar si tiene tickets activos.'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.configurations.activities', [
            'activities' => Activity::simplePaginate(5),
        ]);
    }
}
