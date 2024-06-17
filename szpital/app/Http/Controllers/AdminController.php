<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use PDO;

class AdminController extends Controller
{
    public function showAdminPanel(Request $request)
    {
        $user = $request->user();
        if (Gate::denies('access-admin')) {
            abort(403);
        }

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
        return view('admin', compact('stats'));
    }
}
