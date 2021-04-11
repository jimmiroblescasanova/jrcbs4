<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Contact;
use App\Models\Tag;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function index()
    {
        return view('tickets.index');
    }

    public function create()
    {
        return view('tickets.create', [
            'contacts' => Contact::pluck('name', 'id'),
            'tags' => Tag::pluck('name', 'id'),
            'activities' => Activity::pluck('name', 'id'),
        ]);
    }
}
