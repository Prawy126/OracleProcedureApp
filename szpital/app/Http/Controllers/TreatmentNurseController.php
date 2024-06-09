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

        DB::transaction(function () use (&$stats) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare("
                DECLARE
                    v_stats szpital_stats.stats_rec;
                BEGIN
                    szpital_stats.get_stats(v_stats);
                    :patient_count := v_stats.patient_count;
                    :procedure_count := v_stats.procedure_count;
                    :doctor_count := v_stats.doctor_count;
                    :nurse_count := v_stats.nurse_count;
                END;
            ");

            $stmt->bindParam(':patient_count', $patientCount, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':procedure_count', $procedureCount, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':doctor_count', $doctorCount, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':nurse_count', $nurseCount, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);

            $stmt->execute();

            $stats = [
                'patient_count' => $patientCount,
                'procedure_count' => $procedureCount,
                'doctor_count' => $doctorCount,
                'nurse_count' => $nurseCount,
            ];
        });

        $data = [
            'nurses' => Nurse::all(),
            'procedures' => Procedure::all(),
            'treatmentNurses' => TreatmentNurse::all(),
        ];
        return view('admin', [
            'view' => 'nurseTreatments',
            'data' => $data,
            'stats' => $stats
        ])->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
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
        DB::transaction(function () use (&$stats) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare("
                DECLARE
                    v_stats szpital_stats.stats_rec;
                BEGIN
                    szpital_stats.get_stats(v_stats);
                    :patient_count := v_stats.patient_count;
                    :procedure_count := v_stats.procedure_count;
                    :doctor_count := v_stats.doctor_count;
                    :nurse_count := v_stats.nurse_count;
                END;
            ");

            $stmt->bindParam(':patient_count', $patientCount, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':procedure_count', $procedureCount, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':doctor_count', $doctorCount, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':nurse_count', $nurseCount, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);

            $stmt->execute();

            $stats = [
                'patient_count' => $patientCount,
                'procedure_count' => $procedureCount,
                'doctor_count' => $doctorCount,
                'nurse_count' => $nurseCount,
            ];
        });

        $data = [
            'nurses' => Nurse::all(),
            'procedures' => Procedure::all(),
            'treatmentNurses' => TreatmentNurse::all(),
        ];
        return view('admin', [
            'view' => 'nurseTreatments',
            'data' => $data,
            'stats' => $stats
        ])->with('success', 'User updated successfully.');
    }


    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('
                BEGIN
                    UPDATE_TREATMENTS_NURSES(:p_ID, :p_NEW_PROCEDURE_ID);
                END;
            ');

            $newProcedureId = $request->input('procedure_id');

            $stmt->bindParam(':p_ID', $id, PDO::PARAM_INT);
            $stmt->bindParam(':p_NEW_PROCEDURE_ID', $newProcedureId, PDO::PARAM_INT);

            $stmt->execute();
        });
        DB::transaction(function () use (&$stats) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare("
                DECLARE
                    v_stats szpital_stats.stats_rec;
                BEGIN
                    szpital_stats.get_stats(v_stats);
                    :patient_count := v_stats.patient_count;
                    :procedure_count := v_stats.procedure_count;
                    :doctor_count := v_stats.doctor_count;
                    :nurse_count := v_stats.nurse_count;
                END;
            ");

            $stmt->bindParam(':patient_count', $patientCount, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':procedure_count', $procedureCount, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':doctor_count', $doctorCount, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':nurse_count', $nurseCount, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);

            $stmt->execute();

            $stats = [
                'patient_count' => $patientCount,
                'procedure_count' => $procedureCount,
                'doctor_count' => $doctorCount,
                'nurse_count' => $nurseCount,
            ];
        });

        $data = [
            'nurses' => Nurse::all(),
            'procedures' => Procedure::all(),
            'treatmentNurses' => TreatmentNurse::all(),
        ];
        return view('admin', [
            'view' => 'nurseTreatments',
            'data' => $data,
            'stats' => $stats
        ])->with('success', 'User updated successfully.');
    }

    public function edit($id)
{
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
            $treatmentNurse =  $result[0];
        }
    });

    if ($treatmentNurse === null) {
        return redirect()->route('admin')->with('error', 'Treatment Nurse not found.');
    }
    //dd($treatmentNurse);
    $nurses = Nurse::select('id', 'name', 'surname')->get();
    $procedures = Procedure::select('id', 'date')->get();
    //dd($nurses);

    return view('adminElements.treatmentsNurseEdit', compact('treatmentNurse', 'nurses', 'procedures'));
}

}
