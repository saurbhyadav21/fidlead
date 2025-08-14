<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketResponseController extends Controller
{
    public function store(Request $request, $id)
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

        return redirect()->route('tickets.show', $id)->with('success', 'Response added successfully.');
    }
}