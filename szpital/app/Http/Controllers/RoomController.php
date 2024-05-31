<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = DB::select('SELECT * FROM rooms');
        return view('saleTab', ['rooms' => $rooms]);
    }

    public function show($id)
    {
        $room = null;
        DB::transaction(function () use ($id, &$room) {
            $cursor = DB::getPdo()->prepare('BEGIN GET_ROOM(:id, :cursor); END;');
            $cursor->bindParam(':id', $id);
            $cursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);
            $cursor->execute();
            $cursor->fetch(\PDO::FETCH_ASSOC);
            $cursor->closeCursor();
        });

        return response()->json($room);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $stmt = DB::getPdo()->prepare('BEGIN ADD_ROOM(:rnumber, :rlocation, :status, :type_room); END;');
            $stmt->bindParam(':rnumber', $request->input('rnumber'));
            $stmt->bindParam(':rlocation', $request->input('rlocation'));
            $stmt->bindParam(':status', $request->input('status'));
            $stmt->bindParam(':type_room', $request->input('type_room'));
            $stmt->execute();
        });

        return redirect()->route('rooms.index');
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $stmt = DB::getPdo()->prepare('BEGIN UPDATE_ROOM(:id, :rnumber, :rlocation, :status, :type_room); END;');
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':rnumber', $request->input('rnumber'));
            $stmt->bindParam(':rlocation', $request->input('rlocation'));
            $stmt->bindParam(':status', $request->input('status'));
            $stmt->bindParam(':type_room', $request->input('type_room'));
            $stmt->execute();
        });

        return redirect()->route('rooms.index');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $stmt = DB::getPdo()->prepare('BEGIN DELETE_ROOM(:id); END;');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        });

        return redirect()->route('rooms.index');
    }
}
