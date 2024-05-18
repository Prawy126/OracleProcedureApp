<?php

namespace App\Http\Controllers;

use App\Models\room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = room::all();
        return view('roomsTab', [
            'rooms' => $rooms,
        ]);
    }
}
