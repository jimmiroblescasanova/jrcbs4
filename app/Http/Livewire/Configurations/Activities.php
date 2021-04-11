<?php

namespace App\Http\Livewire\Configurations;

use App\Models\Activity;
use Livewire\Component;
use Livewire\WithPagination;

class Activities extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name;

    protected $rules = [
        'name' => ['required', 'string', 'min:5'],
    ];

    public function save()
    {
        $this->validate();

        Activity::create([
            'name' => $this->name,
        ]);

        $this->emit('hideModalTrigger');
    }

    public function render()
    {
        return view('livewire.configurations.activities', [
            'activities' => Activity::paginate(),
        ]);
    }
}
