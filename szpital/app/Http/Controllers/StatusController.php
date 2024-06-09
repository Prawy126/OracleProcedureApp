<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
    // Display a listing of the statuses.
    public function index(Request $request)
    {
        $search = $request->input('search');
        $statuses = Status::when($search, function ($query, $search) {
            return $query->where('status', 'like', "%$search%");
        })->get();

        return view('statusyTab', compact('statuses'));
    }

    // Store a newly created status in storage.
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        Status::create($request->all());

        return redirect()->route('statusIndex')->with('success', 'Status created successfully.');
    }

    // Show the form for editing the specified status.
    public function edit(Status $status)
    {
        return view('edycjaStatusy', compact('status'));
    }

    // Update the specified status in storage.
    public function update(Request $request, Status $status)
    {
        $request->validate([
            'status' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $status->update($request->all());

        return redirect()->route('statusIndex')->with('success', 'Status updated successfully.');
    }

    // Remove the specified status from storage.
    public function destroy(Status $status)
    {
        $status->delete();

        return redirect()->route('statusIndex')->with('success', 'Status deleted successfully.');
    }
}
