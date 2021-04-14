<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveTicketRequest;
use App\Models\Tag;
use App\Models\Ticket;
use App\Models\Contact;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(SaveTicketRequest $request)
    {
        $ticket = Ticket::create($request->validated());

        session()->flash('message', "Registro agregado correctamente.");

        return redirect()->route('tickets.index');
    }
}
