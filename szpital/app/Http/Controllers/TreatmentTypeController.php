<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TreatmentTypeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $treatmentTypes = DB::select('SELECT * FROM TREATMENT_TYPES WHERE NAME LIKE ?', ['%' . $search . '%']);
        return view('typZabiegowTab', compact('treatmentTypes'));
    }

    public function create()
    {
        return view('treatmentTypes.create');
    }

    public function store(Request $request)
    {
        DB::executeProcedure('ADD_TREATMENT_TYPE', [
            'p_ID' => $request->id,
            'p_NAME' => $request->name,
            'p_DESCRIPTION' => $request->description,
            'p_RECOMMENDATIONS_BEFORE_SURGERY' => $request->recommendations_before_surgery,
            'p_RECOMMENDATIONS_AFTER_SURGERY' => $request->recommendations_after_surgery,
            'p_CREATED_AT' => now(),
        ]);

        return redirect()->route('typZapiegowTab')->with('success', 'Treatment Type added successfully');
    }

    public function edit($id)
    {
        $treatmentType = DB::selectOne('SELECT * FROM TREATMENT_TYPES WHERE ID = ?', [$id]);
        return view('treatmentTypes.edit', compact('treatmentType'));
    }

    public function update(Request $request, $id)
    {
        DB::executeProcedure('UPDATE_TREATMENT_TYPE', [
            'p_ID' => $id,
            'p_NAME' => $request->name,
            'p_DESCRIPTION' => $request->description,
            'p_RECOMMENDATIONS_BEFORE_SURGERY' => $request->recommendations_before_surgery,
            'p_RECOMMENDATIONS_AFTER_SURGERY' => $request->recommendations_after_surgery,
            'p_UPDATED_AT' => now(),
        ]);

        return redirect()->route('treatmentTypes.index')->with('success', 'Treatment Type updated successfully');
    }

    public function destroy($id)
    {
        DB::executeProcedure('DELETE_TREATMENT_TYPE', ['p_ID' => $id]);
        return redirect()->route('treatmentTypes.index')->with('success', 'Treatment Type deleted successfully');
    }
}
