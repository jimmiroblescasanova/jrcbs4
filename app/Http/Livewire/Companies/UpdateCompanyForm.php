<?php

namespace App\Http\Livewire\Companies;

use App\Models\Company;
use Livewire\Component;

class UpdateCompanyForm extends Component
{
    public $name, $rfc, $idCompany;

    protected $listeners = [
        'editModal',
    ];

    protected $rules = [
        'name' => ['required', 'min:5'],
        'rfc' => ['required', 'min:12', 'max:13']
    ];

    public function editModal(Company $company)
    {
        $this->idCompany = $company->id;
        $this->name = $company->name;
        $this->rfc = $company->rfc;
    }

    public function update()
    {
        $this->validate();

        $company = Company::findOrFail($this->idCompany);
        $company->update([
            'name' => $this->name,
            'rfc' => $this->rfc,
        ]);

        $this->emit('companyAddedOrUpdated');
    }

    public function render()
    {
        return view('livewire.companies.update-company-form');
    }
}
