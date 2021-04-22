<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveCommentRequest;
use App\Http\Requests\SaveTicketRequest;
use App\Models\Tag;
use App\Models\Ticket;
use App\Models\Contact;
use App\Models\Activity;
use App\Models\Comment;
use App\Models\User;
use App\Notifications\NewComment;
use App\Notifications\TicketAssigned;
use App\Notifications\TicketClosed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
            'users' => User::pluck('name', 'id'),
        ]);
    }

    public function store(SaveTicketRequest $request)
    {
        $ticket = Ticket::create($request->validated());

        $data = [
            'id' => $ticket->id,
            'activity' => $ticket->activity->name,
        ];

        User::findOrFail($ticket->assigned_to)->notify(new TicketAssigned($data));

        session()->flash('message', "Registro agregado correctamente.");

        return redirect()->route('tickets.index');
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', [
            'ticket' => $ticket,
            'activities' => Activity::pluck('name', 'id'),
        ]);
    }

    public function update(Ticket $ticket, Request $request)
    {
        $ticket->update([
            'activity_id' => $request->activity_id,
        ]);

        return redirect()->route('tickets.index');
    }

    public function close(Ticket $ticket)
    {
        $ticket->update([
            'active' => false,
            'ended_at' => NOW(),
        ]);

        $data = [
            'id' => $ticket->id,
            'message' => 'Ticket cerrado',
        ];

        User::findOrFail($ticket->created_by)->notify(new TicketClosed($data));

        return redirect()->route('tickets.index');
    }

    public function addComment(SaveCommentRequest $request, Ticket $ticket)
    {
        $data = [
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ];

        Comment::create($data);
        User::findOrFail($ticket->assigned_to)->notify(new NewComment($data));

        return redirect()->back();
    }
}
