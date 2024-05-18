<?php

namespace App\Http\Controllers;

use App\Models\medicin;
use Illuminate\Http\Request;

class MedicinController extends Controller
{
    public function index()
    {
        $medicines = medicin::all();
        return view('lekiTab', [
            'medicines' => $medicines,
        ]);
    }
}
