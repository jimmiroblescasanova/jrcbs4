<?php

namespace App\Http\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class ShowContactsTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortDirection = 'desc';

    protected $listeners = [
        'deleteContact'
    ];

    protected $queryString = [
        'search' => ['except' => ''],
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

    public function updatedsearch()
    {
        $this->resetPage();
    }

    public function updatedperPage()
    {
        $this->resetPage();
    }

    public function deleteContact(Contact $contact)
    {
        if ($contact->tickets()->exists()) {
            $this->emit('LiveAlert', [
                'icon' => 'error',
                'title' => 'Error al eliminar',
                'message' => 'No se puede eliminar si tiene tickets activos.'
            ]);
        } else {
            $contact->delete();
            $this->emit('LiveAlert', [
                'icon' => 'success',
                'title' => 'Eliminación exitosa',
                // 'message' => 'No se puede eliminar si tiene tickets activos.'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.contacts.show-contacts-table', [
            'contacts' => Contact::search($this->search)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }
}
