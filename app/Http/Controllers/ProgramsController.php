<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('configurations.programs.index', [
            'programs' => Program::orderBy('name')->paginate(5),
        ]);
    }

    public function create()
    {
        return view('configurations.programs.create', [
            'program' => new Program(),
        ]);
    }

    public function store(Request $request)
    {
        $result = Program::create([
            'name' => $request->name,
            'annual_license' => $request->annual_license,
        ]);

        return redirect()->route('configurations.programs.index');
    }

    public function edit(Program $program)
    {
        return view('configurations.programs.edit', [
            'program' => $program,
        ]);
    }

    public function update(Request $request, Program $program)
    {
        $program->update([
            'name' => $request->name,
            'annual_license' => $request->annual_license,
        ]);

        return redirect()->route('configurations.programs.index');
    }

    public function destroy()
    {
        if (request()->ajax())
        {
            $result = Program::findOrFail(request()->input('id'))->delete();

            if (!$result) {
                return response()->json(['response'=>$result], 500);
            }

            return response()->json(['response'=>$result]);
        }
    }
}
