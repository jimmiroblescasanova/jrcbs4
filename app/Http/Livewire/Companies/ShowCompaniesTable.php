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
    public $orderByDesc = true;
    public $searchQuery = '';

    protected $listeners = [
        'companyAdded',
    ];

    public function companyAdded()
    {
        session()->flash('message', 'Registro guardado');
    }

    public function updatedsearchQuery()
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
            'companies' => Company::search($this->searchQuery)
                ->orderBy('id', $this->orderByDesc ? 'DESC' : 'ASC')
                ->paginate($this->perPage),
        ]);
    }
}
