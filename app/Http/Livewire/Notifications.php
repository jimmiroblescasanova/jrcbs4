<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class Notifications extends Component
{
    public $notifications;

    public function show($id, DatabaseNotification $notification)
    {
        $notification->delete();

        return redirect()->route('tickets.show', $id);
    }

    public function mount()
    {
        $this->notifications = Auth::user()->notifications;
    }

    public function readAll()
    {
        $this->notifications->delete();
        $this->notifications = Auth::user()->notifications;
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
