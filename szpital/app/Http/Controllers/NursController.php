<?php

namespace App\Http\Controllers;

use App\Models\nurse;
use Illuminate\Http\Request;

class NursController extends Controller
{
    public function index()
    {
        $nurses = nurse::all();
        return view('pielegniarkiTab', [
            'nurses' => $nurses,
        ]);
    }
}
