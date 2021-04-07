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
        'companyAddedOrUpdated',
        'deleteCompany',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function companyAddedOrUpdated()
    {
        session()->flash('message', 'Registro guardado de forma exitosa.');
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

    public function deleteCompany(Company $company)
    {
        $company->delete();
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
