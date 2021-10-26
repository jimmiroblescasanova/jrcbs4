<?php

namespace App\Http\Livewire\Reports;

use App\Models\Company;
use Livewire\Component;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;

class CompaniesContacts extends Component
{
    public $show, $order, $status;

    protected $rules = [
        'show' => 'required',
        'order' => 'required',
        'status' => 'nullable',
    ];

    public function generate()
    {
        $this->validate();

        if ($this->status) {
            $companies = Company::qReportContacts($this->show)
                ->orderBy('name', $this->order)
                ->get();
        } else {
            $companies = Company::qReportContacts($this->show)
                ->where('inactive', 0)
                ->orderBy('name', $this->order)
                ->get();
        }

        $pdf = PDF::loadView('reports.companies-contacts', compact('companies'));
        $result = Storage::disk('public')->put('reports/report.pdf', $pdf->output(), 'public');

        return $this->emit('generateReport', $result);
    }

    public function render()
    {
        return view('livewire.reports.companies-contacts')
            ->layout('layouts.reports', [
                'title' => 'Reporte de relación: Empresas - Contactos'
            ]);
    }
}
