<?php

namespace App\Http\Controllers;

use App\Exports\CompaniesExport;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Program;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class CompaniesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('companies.index', [
            'programs' => Program::orderBy('name')->get(),
        ]);
    }

    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create([
            'name' => $request->name,
            'rfc' => $request->rfc,
            'tradename' => $request->tradename,
        ]);

        foreach ($request->programs as $program) {
            $company->programs()->attach($program);
        }

        return redirect()->route('companies.show', $company)->with('success', 'Empresa creada correctamente');
    }

    public function show(Company $company)
    {
        return view('companies.show', [
            'company' => $company,
            'programs' => Program::orderBy('name')->get(),
        ]);
    }

    public function update(Company $company, UpdateCompanyRequest $request)
    {
        $company->update($request->validated());

        return redirect()->route('companies.show', $company)->with('success', 'Los datos se han actualizado con éxito');
    }

    public function sync(Company $company, Request $request)
    {
        $company->programs()->sync($request->programs);

        return redirect()->back()->with('success', 'Los programas asociados se han actualizado.');
    }

    public function destroy(Company $company)
    {
        $name = $company->name;

        $company->delete();

        session()->flash('message', "La empresa: <b>{$name}</b>, se ha eliminado.");

        return redirect()->route('companies.index');
    }

    public function export()
    {
        return Excel::download(new CompaniesExport, 'empresas-' . NOW()->format('dmY') . '.xlsx');
    }

    public function report1(Request $request)
    {
        if ($request->status) {
            $companies = Company::qReportContacts($request->show)
                ->orderBy('name', $request->order)
                ->get();
        } else {
            $companies = Company::qReportContacts($request->show)
                ->where('inactive', '=', 0)
                ->orderBy('name', $request->order)
                ->get();
        }

        $pdf = PDF::loadView('companies.reports.CompaniesContactsReport', compact('companies'));

        return $pdf->setPaper('letter', 'portrait')->download('report-' . NOW()->format('ymd-s'));
    }

    public function report2(Request $request)
    {
        if ($request->status) {
            $companies = Company::qReportPrograms($request->show, $request->programs)
                ->orderBy('name', $request->order)
                ->get();
        } else {
            $companies = Company::qReportPrograms($request->show, $request->programs)
                ->where('inactive', 0)
                ->orderBy('name', $request->order)
                ->get();
        }


        $pdf = PDF::loadView('companies.reports.CompaniesProgramsReport', compact('companies'));

        return $pdf->setPaper('letter', 'portrait')->download('report-' . NOW()->format('ymd-s'));
    }
}
