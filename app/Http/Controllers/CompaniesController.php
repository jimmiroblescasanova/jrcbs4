<?php

namespace App\Http\Controllers;

use App\Exports\CompaniesExport;
use Maatwebsite\Excel\Facades\Excel;

class CompaniesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('companies.index');
    }

    public function edit()
    {
        return "hola!";
    }

    public function export()
    {
        return Excel::download(new CompaniesExport, 'empresas-' . NOW()->format('dmY') . '.xlsx');
    }
}
