<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Nurse;
use App\Models\Procedure;
use App\Models\TreatmentNurse;
use PDO;

class TreatmentNurseController extends Controller
{
    public function index(Request $request)
    {
        $view = $request->query('view', 'default');

        // Pobranie danych
        $nurses = Nurse::select('id', 'name', 'surname')->get();
        $procedures = Procedure::select('id', 'date')->get();
        $treatmentNurses = DB::select('SELECT * FROM TREATMENTS_NURSES');

        // Przekazanie danych do widoku
        $data = [
            'nurses' => $nurses,
            'procedures' => $procedures,
            'treatmentNurses' => $treatmentNurses,
        ];

        return view('admin', compact('view', 'data'));
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('
                BEGIN
                    ADD_TREATMENTS_NURSES(:p_NURSE_ID, :p_PROCEDURE_ID);
                END;
            ');

            $nurse_id = $request->input('nurse_id');
            $procedure_id = $request->input('procedure_id');

            $stmt->bindParam(':p_NURSE_ID', $nurse_id, PDO::PARAM_INT);
            $stmt->bindParam(':p_PROCEDURE_ID', $procedure_id, PDO::PARAM_INT);

            $stmt->execute();
        });

        return redirect()->route('admin')->with('success', 'Treatment Nurse added successfully');
    }

    public function update(Request $request, $nurse_id)
    {
        DB::transaction(function () use ($request, $nurse_id) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('
                BEGIN
                    UPDATE_TREATMENTS_NURSES(:p_NURSE_ID, :p_PROCEDURE_ID);
                END;
            ');

            $procedure_id = $request->input('procedure_id');

            $stmt->bindParam(':p_NURSE_ID', $nurse_id, PDO::PARAM_INT);
            $stmt->bindParam(':p_PROCEDURE_ID', $procedure_id, PDO::PARAM_INT);

            $stmt->execute();
        });

        return redirect()->route('admin')->with('success', 'Treatment Nurse updated successfully');
    }

    public function destroy($nurse_id)
    {
        DB::transaction(function () use ($nurse_id) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('
                BEGIN
                    DELETE_TREATMENTS_NURSES(:p_NURSE_ID);
                END;
            ');

            $stmt->bindParam(':p_NURSE_ID', $nurse_id, PDO::PARAM_INT);
            $stmt->execute();
        });

        return redirect()->route('admin')->with('success', 'Treatment Nurse deleted successfully');
    }
}
