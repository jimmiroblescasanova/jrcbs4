<?php

namespace App\Http\Livewire\Companies;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCompaniesTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 10;
    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';

    protected $listeners = [
        'companyAdded',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function companyAdded()
    {
        session()->flash('message', 'Registro guardado');
    }

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

    public function render()
    {
        return view('livewire.companies.show-companies-table', [
            'companies' => Company::search($this->search)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }
}
