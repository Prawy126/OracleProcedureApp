<?php
namespace App\Http\Controllers;

use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use Illuminate\Support\Facades\Gate;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

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
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        $validated = $request->validate([
            'rnumber' => 'required|string|max:200',
            'rlocation' => 'required|string|max:200',
            'status' => 'required|string|max:200',
            'type_room' => 'required|string|max:200',
            'seats' => 'required|integer|min:0',
        ], [
            'rnumber.required' => 'Pole numer sali jest wymagane.',
            'rnumber.string' => 'Pole numer sali musi być ciągiem znaków.',
            'rnumber.max' => 'Pole numer sali nie może przekraczać 200 znaków.',
            'rlocation.required' => 'Pole lokalizacja sali jest wymagane.',
            'rlocation.string' => 'Pole lokalizacja sali musi być ciągiem znaków.',
            'rlocation.max' => 'Pole lokalizacja sali nie może przekraczać 200 znaków.',
            'status.required' => 'Pole status jest wymagane.',
            'status.string' => 'Pole status musi być ciągiem znaków.',
            'status.max' => 'Pole status nie może przekraczać 200 znaków.',
            'type_room.required' => 'Pole typ sali jest wymagane.',
            'type_room.string' => 'Pole typ sali musi być ciągiem znaków.',
            'type_room.max' => 'Pole typ sali nie może przekraczać 200 znaków.',
            'seats.required' => 'Pole liczba miejsc jest wymagane.',
            'seats.integer' => 'Pole liczba miejsc musi być liczbą całkowitą.',
            'seats.min' => 'Pole liczba miejsc nie może być ujemne.',
        ]);

        // Specjalna walidacja dla sali operacyjnej
        if ($request->input('type_room') === 'sala operacyjna' && $request->input('seats') != 1) {
            return back()->withErrors(['seats' => 'Sala operacyjna musi mieć dokładnie 1 miejsce.']);
        }

        DB::transaction(function () use ($validated) {
            $pdo = DB::getPdo();

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

            $stmt->bindParam(':rnumber', $validated['rnumber'], PDO::PARAM_STR);
            $stmt->bindParam(':rlocation', $validated['rlocation'], PDO::PARAM_STR);
            $stmt->bindParam(':status', $validated['status'], PDO::PARAM_STR);
            $stmt->bindParam(':type_room', $validated['type_room'], PDO::PARAM_STR);
            $stmt->bindParam(':seats', $validated['seats'], PDO::PARAM_INT);
            $stmt->execute();
        });

        return redirect()->route('roomIndex');
    }


    public function edit($id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

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
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        $validated = $request->validate([
            'rnumber' => 'required|string|max:200',
            'rlocation' => 'required|string|max:200',
            'status' => 'required|string|max:200',
            'type_room' => 'required|string|max:200',
            'seats' => 'required|integer|min:0',
        ], [
            'rnumber.required' => 'Pole numer sali jest wymagane.',
            'rnumber.string' => 'Pole numer sali musi być ciągiem znaków.',
            'rnumber.max' => 'Pole numer sali nie może przekraczać 200 znaków.',
            'rlocation.required' => 'Pole lokalizacja sali jest wymagane.',
            'rlocation.string' => 'Pole lokalizacja sali musi być ciągiem znaków.',
            'rlocation.max' => 'Pole lokalizacja sali nie może przekraczać 200 znaków.',
            'status.required' => 'Pole status jest wymagane.',
            'status.string' => 'Pole status musi być ciągiem znaków.',
            'status.max' => 'Pole status nie może przekraczać 200 znaków.',
            'type_room.required' => 'Pole typ sali jest wymagane.',
            'type_room.string' => 'Pole typ sali musi być ciągiem znaków.',
            'type_room.max' => 'Pole typ sali nie może przekraczać 200 znaków.',
            'seats.required' => 'Pole liczba miejsc jest wymagane.',
            'seats.integer' => 'Pole liczba miejsc musi być liczbą całkowitą.',
            'seats.min' => 'Pole liczba miejsc nie może być ujemne.',
        ]);

        // Specjalna walidacja dla sali operacyjnej
        if ($request->input('type_room') === 'sala operacyjna' && $request->input('seats') != 1) {
            return back()->withErrors(['seats' => 'Sala operacyjna musi mieć dokładnie 1 miejsce.']);
        }

        DB::transaction(function () use ($validated, $id) {
            $pdo = DB::getPdo();

            $stmt = $pdo->prepare("
                DECLARE
                    v_room_id NUMBER;
                    v_rnumber VARCHAR2(200);
                    v_rlocation VARCHAR2(200);
                    v_status VARCHAR2(200);
                    v_type_room VARCHAR2(200);
                    v_seats NUMBER;
                BEGIN
                    v_room_id := :id;
                    v_rnumber := :rnumber;
                    v_rlocation := :rlocation;
                    v_status := :status;
                    v_type_room := :type_room;
                    v_seats := :seats;
                    szpital.update_room(v_room_id, v_rnumber, v_rlocation, v_status, v_type_room, v_seats);
                END;
            ");


            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':rnumber', $validated['rnumber'], PDO::PARAM_STR);
            $stmt->bindParam(':rlocation', $validated['rlocation'], PDO::PARAM_STR);
            $stmt->bindParam(':status', $validated['status'], PDO::PARAM_STR);
            $stmt->bindParam(':type_room', $validated['type_room'], PDO::PARAM_STR);
            $stmt->bindParam(':seats', $validated['seats'], PDO::PARAM_INT);
            //dd($stmt);
            $stmt->execute();
        });

        return redirect()->route('roomIndex');
    }


    public function destroy($id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

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
