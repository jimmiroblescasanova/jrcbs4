<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function index()
    {
        return view('configurations.activities.index', [
            'activities' => Activity::all(),
        ]);
    }

    public function store(StoreActivityRequest $request)
    {
        Activity::create($request->validated());

        return redirect()->route('configurations.activities.index');
    }

    public function update(Request $request)
    {
        Activity::findOrFail($request['id'])->update([
            'name' => $request['name'],
        ]);

        return redirect()->back();
    }

    public function destroy()
    {
        if (request()->ajax())
        {
            $result = Activity::findOrFail(request()->input('id'))->delete();

            session()->flash('cant-delete', 'El perfil tiene modelos asociados, no se puede eliminar.');
            return response()->json(['response'=>$result]);
        }
    }
}
