<?php

namespace App\Http\Livewire\Tickets;

use App\Models\Tag;
use App\Models\User;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ShowTicketsTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $tags_array, $users_array;
    public $perPage = 10;
    public $active = 1;
    public $tag = null;
    public $user = null;
    public $start_date = null;
    public $end_date = null;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $rules = [
        'start_date' => ['before_or_equal:today'],
        'end_date' => ['after_or_equal:start_date'],
    ];

    protected $queryString = [
        'tag' => ['except' => ''],
        'user' => ['except' => ''],
        'active' => ['except' => 1]
    ];

    public function sortBy($column)
    {
        if ($this->sortField === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $column;
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset([
            'perPage',
            'active',
            'tag',
            'user',
            'start_date',
            'end_date'
        ]);
    }

    public function mount()
    {
        $this->user = Auth::id();
        $this->tags_array = Tag::pluck('name', 'id');
        $this->users_array = User::pluck('name', 'id');
    }

    public function render()
    {
        $query = Ticket::query()
            ->where('active', $this->active == 1 ?? 0)
            ->when($this->start_date && $this->end_date, function ($query) {
                    $query->whereBetween('created_at', [$this->start_date . " 00:00:00", $this->end_date . " 23:59:59"]);
            })->when($this->tag, function ($query) {
                $query->where('tag_id', $this->tag);
            })->when($this->user, function ($query) {
                $query->where('assigned_to', $this->user);
            })->when($this->sortField, function ($query) {
                switch ($this->sortField) {
                    case 'created_at':
                        return $query->orderBy($this->sortField, $this->sortDirection);
                    case 'contact':
                        return $query->orderByContact($this->sortDirection);
                    case 'activity':
                        return $query->orderByActivity($this->sortDirection);
                    case 'user':
                        return $query->orderByUser($this->sortDirection);
                }
            })->paginate($this->perPage);

        return view('livewire.tickets.show-tickets-table', [
            'tickets' => $query,
        ]);
    }
}
