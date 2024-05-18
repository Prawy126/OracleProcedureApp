<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NurseController extends Controller
{
    public function index()
    {
        $nurses = nurse::all();
        return view('pielegniarkiTab', [
            'nurses' => $nurses,
        ]);
}
