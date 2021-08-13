<?php

namespace App\Http\Controllers;

use App\Exports\CompaniesExport;
use App\Http\Requests\StoreCompanyRequest;
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
            'programs' => Program::all()
        ]);
    }

    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create([
            'name' => $request->name,
            'rfc' => $request->rfc,
        ]);

        foreach($request->programs as $program)
        {
            $company->programs()->attach($program);
        }

        return $request;
    }

    public function show(Company $company)
    {
        return view('companies.show', [
            'company' => $company,
            'programs' => Program::all(),
        ]);
    }

    public function update(Company $company, Request $request)
    {
        $company->update([
            'name' => $request->name,
            'rfc' => $request->rfc,
        ]);

        return redirect()->route('companies.show', $company);
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

    public function report(Request $request)
    {
        $companies = Company::report($request->show)
            ->orderBy('name', $request->order)
            ->get();

        $pdf = PDF::loadView('companies.reports.companies_contacts_relationships', compact('companies'));
        return $pdf->setPaper('letter', 'portrait')->stream();

    }
}
