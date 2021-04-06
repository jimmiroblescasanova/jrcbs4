<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return view('companies.index');
    }
}
