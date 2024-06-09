<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Procedure;
use App\Models\TreatmentDoctor;
use Illuminate\Support\Facades\DB;
use PDO;

class TreatmentDoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::select('id', 'name', 'surname')->get();
        $procedures = Procedure::select('id', 'name as procedure_name', 'date')->get();
        $treatmentDoctors = TreatmentDoctor::all();

        // Przekazanie danych do widoku
        return view('adminElements.doctorsTreatments', [
            'doctors' => $doctors,
            'procedures' => $procedures,
            'treatmentDoctors' => $treatmentDoctors,
        ]);
    }
}

