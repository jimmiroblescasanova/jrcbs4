<?php

namespace App\Http\Livewire\Companies;

use App\Models\Company;
use Livewire\Component;

class CreateCompanyForm extends Component
{
    public $name, $rfc;

    protected $rules = [
        'name' => ['required', 'min:5'],
        'rfc' => ['required', 'min:12', 'max:13']
    ];

    public function save()
    {
        $this->validate();

        Company::create(['name' => $this->name,
            'rfc' => $this->rfc,
        ]);

        $this->emit('companyAddedOrUpdated');
    }

    public function render()
    {
        return view('livewire.companies.create-company-form');
    }
}
