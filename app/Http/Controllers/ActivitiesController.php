<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Models\Activity;
use http\Env\Response;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function index()
    {
        return view('configurations.activities.index', [
            'activities' => Activity::orderBy('name')->paginate(5),
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

            if (!$result) {
                return response()->json([
                    'response' => $result
                ], 500);
            }

            return response()->json([
                'response' => $result
            ]);
        }
    }
}
