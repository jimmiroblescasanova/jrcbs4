<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Reminder;
use Illuminate\Support\Facades\Auth;

class Reminders extends Component
{
    public $reminderTitle;
    public $reminderDueDate;

    public function resetFilters()
    {
        $this->reset(['reminderTitle', 'reminderDueDate']);
    }

    public function checkReminder($id)
    {
        $reminder = Reminder::findOrFail($id);
        $reminder->update([
            'done' => !$reminder->done,
        ]);
    }

    public function save()
    {
        Reminder::create([
            'title' => $this->reminderTitle,
            'user_id' => Auth::id(),
            'due_date' => Carbon::parse($this->reminderDueDate)->format('Y-m-d'),
        ]);

        $this->resetFilters();
    }

    public function render()
    {
        return view('livewire.reminders', [
            'reminders' => Reminder::all(),
        ]);
    }
}
