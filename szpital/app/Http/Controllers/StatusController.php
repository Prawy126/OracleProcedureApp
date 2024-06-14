<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use PDO;

class StatusController extends Controller
{
    // Display a listing of the statuses.
    public function index(Request $request)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        $search = $request->input('search');
        $statuses = DB::select('SELECT * FROM STATUSES WHERE STATUS LIKE ?', ["%$search%"]);

        return view('statusyTab', compact('statuses'));
    }

}
