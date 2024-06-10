<?php

namespace App\Http\Controllers;

use App\Models\Medicin;
use App\Models\Patient;
use App\Models\AssignmentMedicine;
use Illuminate\Http\Request;

class AssignmentMedicineController extends Controller
{
    public function index()
    {
        $medicins = Medicin::all(['id', 'name']);
        $patients = Patient::all(['id', 'name', 'surname']);
        $assignments = AssignmentMedicine::all();

        return view('adminElements.medicinAssigment', compact('medicins', 'patients', 'assignments'));
    }
}
