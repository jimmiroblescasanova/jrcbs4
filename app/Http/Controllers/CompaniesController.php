<?php

namespace App\Http\Controllers;

use App\Exports\CompaniesExport;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Program;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
            'tradeName' => $request->tradeName,
            'corporate' => 0,
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
            'corporates' => Company::excludeInactive()->where('corporate', 1)->pluck('name', 'id'),
        ]);
    }

    public function update(Company $company, UpdateCompanyRequest $request)
    {
        if ($request['corporate'] === '0' && $company->children()->exists())
        {
            try {
                $company->children()->update([
                    'childrenOf' => null,
                ]);
            } catch (\Exception $e)
            {
                return $e;
            }
        }

        $company->update( $request->validated() );

        return redirect()->route('companies.show', $company)->with('success', 'Los datos se han actualizado con éxito');
    }

    public function sync(Company $company, Request $request)
    {
        $company->programs()->sync($request->programs);

        return redirect()->back()->with('success', 'Los programas asociados se han actualizado.');
    }

    public function corporate(Company $company, Request $request)
    {
        $company->update([
            'childrenOf' => $request['belongsToCorporate'],
        ]);

        return redirect()->back()->with('success', 'Se asocio correctamente la empresa corporativo.');
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

    // Funcion de prueba para la conexion del WS
    public function testSoap()
    {
        $wsdl = "http://192.168.1.3/SdkWs/WebService.asmx?WSDL";
        $authentication = array(
            'userName' => 'jrobles',
            'password' => 'mycode'
        );
        $header = new \SoapHeader(
            'http://tempuri.org/',
            'ValidateUser',
            $authentication,
            false
        );

        $client = new \SoapClient($wsdl);
        $client->__setSoapHeaders($header);

        $res = $client->CrearCFDI([
            'importeTotal' => 1500
        ]);

        dd($res);
    }

}
