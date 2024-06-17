<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Nurse;
use App\Models\Procedure;
use App\Models\TreatmentNurse;
use PDO;
use Illuminate\Support\Facades\Gate;

class TreatmentNurseController extends Controller
{
    public function index(Request $request)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        $nurses = Nurse::select('id', 'name', 'surname')->get();
        $procedures = Procedure::select('id', 'date')->get();
        $treatmentNurses = DB::select('SELECT * FROM TREATMENTS_NURSES');

        $data = [
            'nurses' => $nurses,
            'procedures' => $procedures,
            'treatmentNurses' => $treatmentNurses,
        ];

        return view('adminElements.nurseTreatments', compact('data'));
    }

    public function store(Request $request)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        try {
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

            return redirect()->route('treatmentNurses.index')
                             ->with('success', 'Treatment successfully assigned to nurse.');
        } catch (\PDOException $e) {
            if ($e->getCode() == '20002') {
                // Custom Oracle error code for nurse availability conflict
                return redirect()->route('treatmentNurses.index')
                ->withErrors([
                    'Błąd' => 'Nie można przypisać lekarza do zabiegu, ponieważ prowadzi już zabieg w tym czasie',
                ]);
}

            // Handle other possible exceptions
            return redirect()->route('treatmentNurses.index')
            ->withErrors([
                'Błąd' => 'Nie można przypisać lekarza do zabiegu, ponieważ prowadzi już zabieg w tym czasie2', $e->getMessage(),
            ]);
}
    }


    public function destroy($id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        DB::transaction(function () use ($id) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('
                BEGIN
                    DELETE_TREATMENTS_NURSES(:p_ID);
                END;
            ');

            $stmt->bindParam(':p_ID', $id, PDO::PARAM_INT);
            $stmt->execute();
        });

        $data = [
            'nurses' => Nurse::all(),
            'procedures' => Procedure::all(),
            'treatmentNurses' => TreatmentNurse::all(),
        ];
        return view('adminElements.nurseTreatments', [
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        $validated = $request->validate([
            'nurse_id' => 'required|integer',
            'procedure_id' => 'required|integer',
        ], [
            'nurse_id.required' => 'Pole pielęgniarka jest wymagane.',
            'nurse_id.integer' => 'Pole pielęgniarka musi być liczbą całkowitą.',
            'procedure_id.required' => 'Pole zabieg jest wymagane.',
            'procedure_id.integer' => 'Pole zabieg musi być liczbą całkowitą.',
        ]);

        $newNurseId = $validated['nurse_id'];
        $newProcedureId = $validated['procedure_id'];

        try {
            DB::transaction(function () use ($id, $newNurseId, $newProcedureId) {
                $pdo = DB::getPdo();
                $stmt = $pdo->prepare('
                    BEGIN
                        UPDATE_TREATMENTS_NURSES(:p_ID, :p_NEW_NURSE_ID, :p_NEW_PROCEDURE_ID);
                    END;
                ');

                $stmt->bindParam(':p_ID', $id, PDO::PARAM_INT);
                $stmt->bindParam(':p_NEW_NURSE_ID', $newNurseId, PDO::PARAM_INT);
                $stmt->bindParam(':p_NEW_PROCEDURE_ID', $newProcedureId, PDO::PARAM_INT);

                $stmt->execute();
            });

            return redirect()->route('treatmentNurses.index')->with('success', 'Nurse updated successfully.');
        } catch (\PDOException $e) {
            if ($e->getCode() == '20005') {
                // Custom Oracle error code for nurse availability conflict
                return redirect()->route('treatmentNurses.edit', $id)->withErrors([
                    'Błąd' => 'Nurse is not available at the specified time.',
                ]);
            }

            // Handle other possible exceptions
            return redirect()->route('treatmentNurses.edit', $id)->withErrors([
                'Błąd' => 'An unexpected error occurred. Please try again.',
            ]);
        }
    }


    public function edit($id)
    {

        if (Gate::denies('access-admin')) {
            abort(403);
        }

        $treatmentNurse = null;

        DB::transaction(function () use ($id, &$treatmentNurse) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('
                BEGIN
                    GET_TREATMENTS_NURSES(:p_ID, :p_RESULT);
                END;
            ');

            $stmt->bindParam(':p_ID', $id, PDO::PARAM_INT);
            $stmt->bindParam(':p_RESULT', $resultCursor, PDO::PARAM_STMT);

            $stmt->execute();

            oci_execute($resultCursor, OCI_DEFAULT);
            oci_fetch_all($resultCursor, $result, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);

            if (!empty($result)) {
                $treatmentNurse = $result[0];
            }
        });

        if ($treatmentNurse === null) {
            abort(404);
        }

        $nurses = Nurse::select('id', 'name', 'surname')->get();
        $procedures = Procedure::select('id', 'date')->get();

        return view('adminElements.treatmentsNurseEdit', compact('treatmentNurse', 'nurses', 'procedures'));
    }
}
