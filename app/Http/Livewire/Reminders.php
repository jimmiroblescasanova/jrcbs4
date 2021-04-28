<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reminder;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Reminders extends Component
{
    public $reminderTitle;
    public $reminderDueDate;

    use WithPagination;
    protected $paginationTheme = "bootstrap";

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
            'due_date' => $this->reminderDueDate,
        ]);

        $this->resetFilters();
    }

    public function delete($id)
    {
        Reminder::findOrFail($id)->delete();
    }

    public function render()
    {
        $reminders = Reminder::query()
            ->orderBy('done', 'asc')
            ->orderBy('due_date', 'asc')
            ->simplePaginate(8);

        return view('livewire.reminders', [
            'reminders' => $reminders,
        ]);
    }
}
