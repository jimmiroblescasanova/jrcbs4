<?php

namespace App\Http\Livewire\Tickets;

use App\Models\Tag;
use App\Models\User;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTicketsTable extends Component
{
    use WithPagination;

    public $tags, $users;

    public function mount()
    {
        $this->tags = Tag::pluck('name', 'id');
        $this->users = User::pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.tickets.show-tickets-table', [
            'tickets' => Ticket::paginate(),
        ]);
    }
}
