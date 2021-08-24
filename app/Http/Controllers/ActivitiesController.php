<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Models\Activity;

class ActivitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

    public function update()
    {
        if (request()->ajax()) {
            $result = Activity::findOrFail(request()->input('id'))->update([
                'name' => request()->input('name'),
            ]);

            if (!$result) {
                return response()->json([
                    'result' => $result,
                ], 500);
            }

            return response()->json([
                'result' => $result,
            ]);
        }
    }

    public function destroy()
    {
        if (request()->ajax()) {
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
