<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusController extends Controller
{
    // Display a listing of the statuses.
    public function index(Request $request)
    {
        $search = $request->input('search');
        $statuses = DB::select('SELECT * FROM STATUSES WHERE STATUS LIKE ?', ["%$search%"]);

        return view('statusyTab', compact('statuses'));
    }

    // Store a newly created status in storage.
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $status = $request->input('status');
        $description = $request->input('description');

        DB::statement('CALL ADD_STATUS(?, ?)', [$status, $description]);

        return redirect()->route('statusIndex')->with('success', 'Status created successfully.');
    }

    // Show the form for editing the specified status.
    public function edit($id)
    {
        $result = DB::select('
            DECLARE
                p_STATUS VARCHAR2(255);
                p_DESCRIPTION CLOB;
                p_CREATED_AT TIMESTAMP;
                p_UPDATED_AT TIMESTAMP;
            BEGIN
                GET_STATUS(:p_ID, p_STATUS, p_DESCRIPTION, p_CREATED_AT, p_UPDATED_AT);
                :p_STATUS := p_STATUS;
                :p_DESCRIPTION := p_DESCRIPTION;
            END;
        ', [
            'p_ID' => $id,
        ]);

        // Extract the status and description from the result
        $status = [
            'id' => $id,
            'status' => $result[0]->p_STATUS,
            'description' => $result[0]->p_DESCRIPTION
        ];

        return view('edycjaStatusy', compact('status'));
    }

    // Update the specified status in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $status = $request->input('status');
        $description = $request->input('description');

        DB::statement('CALL UPDATE_STATUS(?, ?, ?)', [$id, $status, $description]);

        return redirect()->route('statusIndex')->with('success', 'Status updated successfully.');
    }

    // Remove the specified status from storage.
    public function destroy($id)
    {
        DB::statement('CALL DELETE_STATUS(?)', [$id]);

        return redirect()->route('statusIndex')->with('success', 'Status deleted successfully.');
    }
}
