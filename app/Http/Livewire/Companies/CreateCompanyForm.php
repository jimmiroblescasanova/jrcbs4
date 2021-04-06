<?php

namespace App\Http\Livewire\Companies;

use App\Models\Company;
use Livewire\Component;

class CreateCompanyForm extends Component
{
    public $company = [];

    protected $rules = [
        'company.name' => ['required', 'min:5'],
        'company.rfc' => ['required', 'min:12', 'max:13']
    ];

    public function save()
    {
        $this->validate();

        Company::create([
            'name' => $this->company['name'],
            'rfc' => $this->company['rfc'],
        ]);

        $this->emit('companyAdded');
    }

    public function render()
    {
        return view('livewire.companies.create-company-form');
    }
}
