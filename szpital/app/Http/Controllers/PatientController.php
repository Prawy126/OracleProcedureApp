<?php

namespace App\Http\Controllers;

use App\Models\patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = patient::all();
        return view('pielegniarkiTab', [
            'patients' => $patients,
        ]);
    }
}
