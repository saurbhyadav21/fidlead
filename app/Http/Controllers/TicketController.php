<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Customer;
use App\Models\TicketResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        // // Show all tickets for the current user
        // $tickets = Auth::user()->tickets()->orderBy('created_at', 'desc')->get();
        // // dd($tickets);
        // return view('tickets.index', compact('tickets'));


         // Fetch all tickets
         $tickets = Auth::user()->tickets()->orderBy('created_at', 'desc')->get();

         // Manually fetch users associated with the tickets
         $userIds = $tickets->pluck('user_id')->unique()->filter();
         $users = Customer::whereIn('id', $userIds)->get()->keyBy('id');
 
         // Pass both tickets and users to the view
         return view('tickets.index', compact('tickets', 'users'));
    }

    public function create(Request $request)
    {
        // Show the form for creating a new ticket
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        // Validate and create the new ticket
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function show($id)
    {
        // Show the ticket details and responses
        $ticket = Ticket::with('responses.user')->findOrFail($id);

        // Check if the current user is authorized to view the ticket
        if (Auth::id() !== $ticket->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }

        // Fetch the user's name based on the user_id
        $customerName = Customer::find($ticket->user_id)->name;

        return view('tickets.show', compact('ticket', 'customerName'));
    }

    public function close($id)
    {
        // Close the ticket
        $ticket = Ticket::findOrFail($id);
        $ticket->update(['status' => 'closed']);

        return redirect()->route('tickets.show', $id)->with('success', 'Ticket closed successfully.');
    }

    public function open($id)
    {
        // Reopen the ticket
        $ticket = Ticket::findOrFail($id);
        $ticket->update(['status' => 'open']);

        return redirect()->route('tickets.show', $id)->with('success', 'Ticket reopened successfully.');
    }
}