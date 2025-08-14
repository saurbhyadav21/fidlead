<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use DB;
class AdminTicketController extends Controller
{
    public function index()
    {
        // Fetch all tickets
        $tickets = Ticket::orderBy('created_at', 'desc')->get();

        // Manually fetch users associated with the tickets
        $userIds = $tickets->pluck('user_id')->unique()->filter();
        $users = Customer::whereIn('id', $userIds)->get()->keyBy('id');

        // Pass both tickets and users to the view
        return view('admin.tickets.index', compact('tickets', 'users'));
    }

    public function show($id)
    {
        // Show the ticket details and responses for admins
        $ticket = Ticket::findOrFail($id);
        $responses = $ticket->responses;
        // dd($responses);
        // Fetch the users related to the responses
        $userIds = $responses->pluck('user_id')->unique();
        // dd($userIds);
        $users = Customer::whereIn('id', $userIds)->get()->keyBy('id');

        return view('admin.tickets.show', compact('ticket', 'responses', 'users'));
    }

    public function close($id)
    {
        // Close the ticket
        $ticket = Ticket::findOrFail($id);
        $ticket->update(['status' => 'closed']);
        return redirect()->route('admin.tickets.index')->with('success', 'Ticket closed successfully.');
    }

    public function storeResponse(Request $request, $id)
    {
        // Validate the response
        $request->validate([
            'response' => 'required|string',
        ]);

        // Create a new response for the ticket
        TicketResponse::create([
            'ticket_id' => $id,
            'user_id' => Auth::id(),
            'response' => $request->response,
        ]);

        return redirect()->route('admin.tickets.show', $id)->with('success', 'Response added successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search tickets by ID
        $ticketsById = Ticket::where('id', 'LIKE', "%{$query}%")->get();

        // Search tickets by customer name (fetch user IDs first)
        $userIds = DB::table('customers')
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->pluck('id')
            ->toArray();

        $ticketsByUser = Ticket::whereIn('user_id', $userIds)->get();

        // Combine and deduplicate tickets
        $tickets = $ticketsById->merge($ticketsByUser)->unique('id');

        // Fetch users for displaying in the view
        $users = DB::table('customers')
            ->whereIn('id', $tickets->pluck('user_id'))
            ->get()
            ->keyBy('id');

        return view('admin.tickets.index', compact('tickets', 'users'));
    }

}
