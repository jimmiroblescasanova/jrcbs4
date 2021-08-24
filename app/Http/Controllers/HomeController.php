<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tickets = Ticket::query()
            ->where([
                ['assigned_to', Auth::id()],
                ['ended_at', '=', null]
            ])
            ->oldest()
            ->limit(5)
            ->get();

        return view('home', [
            'tickets' => $tickets,
        ]);
    }
}
