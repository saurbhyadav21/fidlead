<?php

namespace App\Http\Controllers;
use App\Models\Marquee;
use Illuminate\Http\Request;

class MarqueeController extends Controller
{
    // Display all marquee messages for admin dashboard
    public function index()
    {
        $marquees = Marquee::all();
        return view('admin.marquee.index', compact('marquees'));
    }

    // Store a new marquee message
    public function store(Request $request)
    {
        $request->validate(['message' => 'required|string']);
        Marquee::create($request->only('message'));
        return redirect()->back()->with('success', 'Marquee message added successfully');
    }

    // Update an existing marquee message
    public function update(Request $request, $id)
    {
        $request->validate(['message' => 'required|string']);
        $marquee = Marquee::findOrFail($id);
        $marquee->update($request->only('message'));
        return redirect()->back()->with('success', 'Marquee message updated successfully');
    }

    // Delete a marquee message
    public function destroy($id)
    {
        $marquee = Marquee::findOrFail($id);
        $marquee->delete();
        return redirect()->back()->with('success', 'Marquee message deleted successfully');
    }
}
