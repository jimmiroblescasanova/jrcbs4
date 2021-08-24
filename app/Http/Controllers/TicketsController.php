<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Notifications\NewComment;
use App\Notifications\TicketClosed;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TicketAssigned;
use App\Http\Requests\SaveTicketRequest;
use App\Http\Requests\SaveCommentRequest;

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
            'contacts' => Contact::all(),
            'tags' => Tag::pluck('name', 'id'),
            'activities' => Activity::pluck('name', 'id'),
            'users' => User::pluck('name', 'id'),
        ]);
    }

    public function store(SaveTicketRequest $request)
    {
        $ticket = Ticket::create($request->except('attachment'));

        // Save attachment to disk
        if ($request->hasFile('attachment')) {
            $ticket->attachments()->create([
                'filename' => $request->file('attachment')->getClientOriginalName(),
                'route' => $request->file('attachment')->store('tickets'),
            ]);
        }

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

        session()->decrement('pendingTickets');

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
