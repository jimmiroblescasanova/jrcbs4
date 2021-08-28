<?php

namespace App\Http\Livewire\Reports;

use App\Models\Company;
use App\Models\Program;
use Livewire\Component;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;

class CompaniesPrograms extends Component
{
    public $show, $order, $status;
    public $programSelected = [];
    public $programs;

    protected $rules = [
        'show' => 'required',
        'programSelected' => 'required|array',
        'order' => 'required',
        'status' => 'nullable',
    ];

    public function mount()
    {
        $this->programs = Program::pluck('name', 'id');
    }

    public function generate()
    {
        $this->validate();

        if ($this->status) {
            $companies = Company::qReportPrograms($this->show, $this->programSelected)
                ->orderBy('name', $this->order)
                ->get();
        } else {
            $companies = Company::qReportPrograms($this->show, $this->programSelected)
                ->where('inactive', 0)
                ->orderBy('name', $this->order)
                ->get();
        }

        $pdf = PDF::loadView('reports.companies-programs', compact('companies'));
        $result = Storage::put('reports/report.pdf', $pdf->output());

        return $this->emit('generateReport', $result);
    }

    public function render()
    {
        return view('livewire.reports.companies-programs')
            ->layout('layouts.reports', [
                'title' => 'Reporte de relación: Empresas - Programas'
            ]);
    }
}
