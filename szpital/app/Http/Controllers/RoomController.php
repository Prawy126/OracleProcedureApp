<?php
namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $rooms = Room::where('rnumber', 'LIKE', "%$search%")
                         ->orWhere('rlocation', 'LIKE', "%$search%")
                         ->get();
        } else {
            $rooms = Room::all();
        }

        return view('saleTab', [
            'rooms' => $rooms,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'rnumber' => 'required|integer',
            'rlocation' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'type_room' => 'required|string|max:255',
        ]);

        DB::statement('BEGIN ADD_ROOM(:rnumber, :rlocation, :status, :type_room, :seats); END;', [
            'rnumber' => $request->input('rnumber'),
            'rlocation' => $request->input('rlocation'),
            'status' => $request->input('status'),
            'type_room' => $request->input('type_room'),
            'seats' => $request->input('seats')
        ]);

        return redirect()->route('roomIndex');
    }

    public function edit($id)
    {
        $cursor = null;

        DB::getPdo()->beginTransaction();
        $stmt = DB::getPdo()->prepare('BEGIN GET_ROOM(:id, :cursor); END;');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':cursor', $cursor, PDO::PARAM_STMT);
        $stmt->execute();

        oci_execute($cursor, OCI_DEFAULT);
        oci_fetch_all($cursor, $result, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);
        DB::getPdo()->commit();

        if (empty($result)) {
            return redirect()->route('roomIndex');
        }

        $room = $result[0];
        return view('edycjaSale', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rnumber' => 'required|integer',
            'rlocation' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'type_room' => 'required|string|max:255',
        ]);

        DB::statement('BEGIN UPDATE_ROOM(:id, :rnumber, :rlocation, :status, :type_room); END;', [
            'id' => $id,
            'rnumber' => $request->input('rnumber'),
            'rlocation' => $request->input('rlocation'),
            'status' => $request->input('status'),
            'type_room' => $request->input('type_room')
        ]);

        return redirect()->route('roomIndex');
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function() use ($id) {
                DB::statement('BEGIN DELETE_ROOM(:id); END;', ['id' => $id]);
            });

            return redirect()->route('roomIndex');
        } catch (\Exception $e) {
            return redirect()->route('roomIndex');
        }
    }
}
