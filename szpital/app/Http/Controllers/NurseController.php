<?php

namespace App\Http\Controllers;

use App\Models\nurse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NursController extends Controller
{
    public function index()
    {
        $nurses = nurse::all();
        return view('pielegniarkiTab', [
            'nurses' => $nurses,
        ]);
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $surname = $request->input('surname');
        $number = $request->input('number');
        $userId = $request->input('user_id');

        DB::statement('BEGIN ADD_NURSE(:name, :surname, :number, :userId); END;', [
            'name' => $name,
            'surname' => $surname,
            'number' => $number,
            'userId' => $userId
        ]);

        return redirect()->route('nursesIndex');
    }

    public function show($id)
    {
        $nurse = DB::select('BEGIN GET_NURSE(:id, :nurse); END;', [
            'id' => $id,
            'nurse' => null
        ]);

        return view('edycjaPielegniarki', ['nurse' => $nurse]);
    }

    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $surname = $request->input('surname');
        $number = $request->input('number');
        $userId = $request->input('user_id');

        DB::statement('BEGIN UPDATE_NURSE(:id, :name, :surname, :number, :userId); END;', [
            'id' => $id,
            'name' => $name,
            'surname' => $surname,
            'number' => $number,
            'userId' => $userId
        ]);

        return redirect()->route('nurseIndex');
    }

    public function destroy($id)
    {
        DB::statement('BEGIN DELETE_NURSE(:id); END;', [
            'id' => $id
        ]);

        return redirect()->route('nurseIndex');
    }
}
