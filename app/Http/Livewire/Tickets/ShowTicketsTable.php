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
    protected $paginationTheme = 'bootstrap';

    public $tags, $users;
    public $perPage = 10;
    public $tagFilter = null;
    public $activeFilter = 1;
    public $start_date = null;
    public $end_date = null;

    protected $rules = [
        'start_date' => ['before_or_equal:today'],
        'end_date' => ['after_or_equal:start_date'],
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function mount()
    {
        $this->tags = Tag::pluck('name', 'id');
        $this->users = User::pluck('name', 'id');
    }

    public function render()
    {
        $query = Ticket::where('active', $this->activeFilter == 1 ?? 0)
            ->when($this->start_date && $this->end_date, function ($query) {
                $query->whereBetween('created_at', [$this->start_date . " 00:00:00", $this->end_date . " 23:59:59"]);
            })->when($this->tagFilter, function ($query) {
                $query->where('tag_id', $this->tagFilter);
            })->orderBy('created_at', 'desc')->paginate($this->perPage);

        return view('livewire.tickets.show-tickets-table', [
            'tickets' => $query,
        ]);
    }
}
