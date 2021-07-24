<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        return view('configurations.tags.index', [
            'tags' => Tag::all(),
        ]);
    }

    public function store(Request $request)
    {
        $result = Tag::create([
            'name' => $request->name,
            'color' => $request->color,
        ]);

        return redirect()->back();
    }

    public function update(Request $request)
    {
        Tag::findOrFail($request['id'])->update([
            'name' => $request['name'],
            'color' => $request['color'],
        ]);

        return redirect()->back();
    }

    public function destroy()
    {
        if (request()->ajax())
        {
            $result = Tag::findOrFail(request()->input('id'))->delete();

            return response()->json(['response'=>$result]);
        }
    }
}
