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

        return view('admin', compact('view', 'data'));
    }
}
