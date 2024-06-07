<?php

namespace App\Http\Controllers;

use App\Models\AssignmentMedicine;
use App\Models\Doctor;
use App\Models\Medicin;
use App\Models\Nurse;
use App\Models\Patient;
use App\Models\Procedure;
use App\Models\TreatmentDoctor;
use App\Models\TreatmentNurse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class AdminController extends Controller
{
    public function showAdminPanel(Request $request)
    {
        $view = $request->get('view');
        $availableViews = ['accounts', 'doctorsTreatments', 'medicineAssignment', 'nurseTreatments'];

        if (!in_array($view, $availableViews)) {
            $view = null;
        }

        $nurseTreatments = new TreatmentNurseController();

        $data = [];
        switch ($view) {
            case 'accounts':
                $data = [
                    'users' => User::all(),
                ];
                break;
            case 'doctorsTreatments':
                $data = [
                    'doctors' => Doctor::all(),
                    'procedures' => Procedure::all(),
                    'treatmentDoctors' => TreatmentDoctor::all(),
                ];
                break;
            case 'medicineAssignment':
                $data = [
                    'medicins' => Medicin::all(),
                    'patients' => Patient::all(),
                    'assignments' => AssignmentMedicine::all(),
                ];
                break;
            case 'nurseTreatments':
                $data = [
                    'nurses' => Nurse::all(),
                    'procedures' => Procedure::all(),
                    'treatmentNurses' => TreatmentNurse::all(),
                ];
                break;
        }
        $stats = null;

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
        return view('admin', compact('view', 'data','stats'));
    }
}
