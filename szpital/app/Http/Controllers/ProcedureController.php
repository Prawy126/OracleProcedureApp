<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProcedureController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $procedures = DB::table('PROCEDURES')
            ->where('ID', 'like', "%$search%")
            ->orWhere('TREATMENT_TYPE_ID', 'like', "%$search%")
            ->get();

        return view('zabiegiTab', compact('procedures'));
    }

    public function store(Request $request)
    {
        $id = $request->input('id');
        $treatmentTypeId = $request->input('treatment_type_id');
        $roomId = $request->input('room_id');
        $createdAt = now();
        $time = $request->input('time');
        $cost = $request->input('cost');
        $status = $request->input('status');

        DB::statement("CALL ADD_PROCEDURE(?, ?, ?, ?, ?, ?, ?)", [
            $id, $treatmentTypeId, $roomId, $createdAt, $time, $cost, $status
        ]);

        return redirect()->route('proceduresIndex');
    }

    public function update(Request $request, $id)
    {
        $treatmentTypeId = $request->input('treatment_type_id');
        $roomId = $request->input('room_id');
        $updatedAt = now();
        $time = $request->input('time');
        $cost = $request->input('cost');
        $status = $request->input('status');

        DB::statement("CALL UPDATE_PROCEDURE(?, ?, ?, ?, ?, ?, ?)", [
            $id, $treatmentTypeId, $roomId, $updatedAt, $time, $cost, $status
        ]);

        return redirect()->route('proceduresIndex');
    }

    public function destroy($id)
    {
        DB::statement("CALL DELETE_PROCEDURE(?)", [$id]);

        return redirect()->route('proceduresIndex');
    }

    public function show($id)
    {
        $procedure = DB::select("SELECT * FROM PROCEDURES WHERE ID = ?", [$id]);

        return view('edycjaZabiegi', compact('procedure'));
    }

}

