<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\doctor;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = doctor::all();
        return view('lekarzeTab', [
            'doctors' => $doctors,
        ]);
    }

}
