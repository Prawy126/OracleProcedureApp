<?php
namespace App\Http\Controllers;

use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use Illuminate\Support\Facades\Log;

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
        DB::transaction(function () use ($request) {
            $pdo = DB::getPdo();

            $rnumber = $request->input('rnumber');
            $rlocation = $request->input('rlocation');
            $status = $request->input('status');
            $type_room = $request->input('type_room');
            $seats = $request->input('seats');

            $stmt = $pdo->prepare("
                DECLARE
                    v_rnumber VARCHAR2(200);
                    v_rlocation VARCHAR2(200);
                    v_status VARCHAR2(200);
                    v_type_room VARCHAR2(200);
                    v_seats NUMBER;
                BEGIN
                    v_rnumber := :rnumber;
                    v_rlocation := :rlocation;
                    v_status := :status;
                    v_type_room := :type_room;
                    v_seats := :seats;
                    szpital.add_room(v_rnumber, v_rlocation, v_status, v_type_room, v_seats);
                END;
            ");

            $stmt->bindParam(':rnumber', $rnumber, PDO::PARAM_STR);
            $stmt->bindParam(':rlocation', $rlocation, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':type_room', $type_room, PDO::PARAM_STR);
            $stmt->bindParam(':seats', $seats, PDO::PARAM_INT);
            $stmt->execute();
        });

        return redirect()->route('roomIndex');
    }

    public function edit($id)
    {
        $room = null;

        DB::transaction(function () use ($id, &$room) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('BEGIN szpital.get_room(:id, :cursor); END;');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $cursor = null;
            $stmt->bindParam(':cursor', $cursor, PDO::PARAM_STMT);
            $stmt->execute();

            oci_execute($cursor, OCI_DEFAULT);
            oci_fetch_all($cursor, $result, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);

            if (!empty($result)) {
                $room = $result[0];
            }
        });

        if (empty($room)) {
            return redirect()->route('roomIndex')->with('error', 'Room not found.');
        }

        return view('edycjaSale', compact('room'));
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $pdo = DB::getPdo();

            $rnumber = $request->input('rnumber');
            $rlocation = $request->input('rlocation');
            $status = $request->input('status');
            $type_room = $request->input('type_room');

            $stmt = $pdo->prepare("
                DECLARE
                    v_room_id NUMBER;
                    v_rnumber VARCHAR2(200);
                    v_rlocation VARCHAR2(200);
                    v_status VARCHAR2(200);
                    v_type_room VARCHAR2(200);
                BEGIN
                    v_room_id := :id;
                    v_rnumber := :rnumber;
                    v_rlocation := :rlocation;
                    v_status := :status;
                    v_type_room := :type_room;
                    szpital.update_room(v_room_id, v_rnumber, v_rlocation, v_status, v_type_room);
                END;
            ");

            // Bind parameters
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':rnumber', $rnumber, PDO::PARAM_STR);
            $stmt->bindParam(':rlocation', $rlocation, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':type_room', $type_room, PDO::PARAM_STR);
            $stmt->execute();
        });

        return redirect()->route('roomIndex');
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $pdo = DB::getPdo();
                $stmt = $pdo->prepare('BEGIN szpital.delete_room(:id); END;');
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
            });

            return redirect()->route('roomIndex')->with('success', 'Room deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('roomIndex')->with('error', 'Error deleting room: ' . $e->getMessage());
        }
    }
}
