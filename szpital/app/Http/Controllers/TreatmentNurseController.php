<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nurse;
use App\Models\Procedure;
use App\Models\TreatmentNurse;

class TreatmentNurseController extends Controller
{
    public function index(Request $request)
    {
        $view = $request->query('view', 'default');

        // Pobranie danych
        $nurses = Nurse::select('id', 'name', 'surname')->get();
        $procedures = Procedure::select('id', 'date')->get();
        $treatmentNurses = TreatmentNurse::all();

        // Przekazanie danych do widoku
        $data = [
            'nurses' => $nurses,
            'procedures' => $procedures,
            'treatmentNurses' => $treatmentNurses,
        ];

        return view('admin', compact('view', 'data'));
    }
}
