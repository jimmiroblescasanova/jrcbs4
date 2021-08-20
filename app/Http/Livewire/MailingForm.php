<?php

namespace App\Http\Livewire;

use App\Models\Program;
use Livewire\Component;

class MailingForm extends Component
{
    public $programs;
    public $companies;

    public $selectedProgram = NULL;

    public function mount()
    {
        $this->programs = Program::pluck('name', 'id');
        $this->companies = collect();
    }

    public function updatedSelectedProgram($program)
    {
        $this->companies = Program::find($program)->companies()->orderBy('name')->get();
    }

    public function render()
    {
        return view('livewire.mailing-form');
    }
}
