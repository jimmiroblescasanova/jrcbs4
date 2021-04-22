<?php

namespace App\Http\Livewire\Companies;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCompaniesTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;
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
        if ($company->contacts()->exists()) {
            $this->emit('LiveAlert', [
                'icon' => 'error',
                'title' => 'Error al eliminar',
                'message' => 'No se puede eliminar si tiene contactos asociados.'
            ]);
        } else {
            $company->delete();
            $this->emit('LiveAlert', [
                'icon' => 'success',
                'title' => 'Eliminado',
                'message' => 'La empresa ha sido eliminada correctamente.'
            ]);
        }
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
