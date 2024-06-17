<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\TreatmentType;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use Illuminate\Support\Facades\Gate;

class ProcedureController extends Controller
{
    public function index(Request $request)
{
    if (Gate::denies('access-admin')) {
        abort(403);
    }

    $search = $request->input('search', '');
    $procedures = DB::table('PROCEDURES')
        ->where('ID', 'like', "%$search%")
        ->orWhere('TREATMENT_TYPE_ID', 'like', "%$search%")
        ->orWhere('PATIENT_ID', 'like', "%$search%")
        ->get();

    $treatmentTypes = TreatmentType::select('id', 'name')->get();
    $rooms = Room::where('type_room', 'Sala operacyjna')->get();
    return view('zabiegiTab', compact('procedures', 'treatmentTypes', 'rooms'));
}


public function store(Request $request)
{
    if (Gate::denies('access-admin')) {
        abort(403);
    }

    $validated = $request->validate([
        'treatment_type_id' => 'required|integer',
        'room_id' => 'required|integer',
        'date' => 'required|date',
        'time' => 'required|string|max:255',
        'cost' => 'required|numeric|min:0',
        'patient_id' => 'required|integer',
    ], [
        'treatment_type_id.required' => 'Pole typ leczenia jest wymagane.',
        'treatment_type_id.integer' => 'Pole typ leczenia musi być liczbą całkowitą.',
        'room_id.required' => 'Pole pokój jest wymagane.',
        'room_id.integer' => 'Pole pokój musi być liczbą całkowitą.',
        'date.required' => 'Pole data jest wymagane.',
        'date.date' => 'Pole data musi być prawidłową datą.',
        'time.required' => 'Pole czas jest wymagane.',
        'time.string' => 'Pole czas musi być ciągiem znaków.',
        'time.max' => 'Pole czas nie może przekraczać 255 znaków.',
        'cost.required' => 'Pole koszt jest wymagane.',
        'cost.numeric' => 'Pole koszt musi być liczbą.',
        'cost.min' => 'Pole koszt nie może być ujemne.',
        'patient_id.required' => 'Pole pacjent jest wymagane.',
        'patient_id.integer' => 'Pole pacjent musi być liczbą całkowitą.',
    ]);

    $treatmentTypeId = $validated['treatment_type_id'];
    $roomId = $validated['room_id'];
    $date = $validated['date'];
    $time = $validated['time'];
    $cost = $validated['cost'];
    $patientId = $validated['patient_id'];

    try {
        DB::transaction(function () use ($treatmentTypeId, $roomId, $date, $time, $cost, $patientId) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('
                CALL ADD_PROCEDURE(:p0, :p1, :p2, :p3, :p4, :p5)
            ');

            $stmt->bindParam(':p0', $treatmentTypeId, PDO::PARAM_INT);
            $stmt->bindParam(':p1', $roomId, PDO::PARAM_INT);
            $stmt->bindParam(':p2', $date, PDO::PARAM_STR);
            $stmt->bindParam(':p3', $time, PDO::PARAM_STR);
            $stmt->bindParam(':p4', $cost, PDO::PARAM_STR);
            $stmt->bindParam(':p5', $patientId, PDO::PARAM_INT);

            $stmt->execute();
        });

        return redirect()->route('proceduresIndex')->with('success', 'Procedure successfully assigned to patient.');
    } catch (\PDOException $e) {
        if ($e->getCode() == '20003') {
            return redirect()->route('proceduresIndex')->withErrors([
                'Błąd' => 'Patient is not available at the specified time.',
            ]);
        }if ($e->getCode() == '20004') {
            return redirect()->route('proceduresIndex')->withErrors([
                'Błąd' => 'Sala jest zajęta',
            ]);
        }

        return redirect()->route('proceduresIndex')->withErrors([
            'Błąd' => 'An unexpected error occurred. Please try again.', $e->getMessage(),
        ]);
    }
}

public function show($id)
{
    if (Gate::denies('access-admin')) {
        abort(403);
    }

    $procedure = null;

    DB::transaction(function () use ($id, &$procedure) {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare('
            BEGIN
                HOSPITAL.GET_PROCEDURE(:id, :procedure);
            END;
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':procedure', $procedure, PDO::PARAM_STMT);
        $stmt->execute();

        oci_execute($procedure, OCI_DEFAULT);
        oci_fetch_all($procedure, $result, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);

        if (!empty($result)) {
            $procedure = $result[0];
        }
    });

    if (empty($procedure)) {
        return redirect()->route('proceduresIndex')->with('error', 'Procedure not found.');
    }

    $treatmentTypes = TreatmentType::select('id', 'name')->get();
    $rooms = Room::where('type_room', 'Sala operacyjna')->get();

    return view('edycjaZabiegi', compact('procedure', 'treatmentTypes', 'rooms'));
}


public function update(Request $request, $id)
{
    if (Gate::denies('access-admin')) {
        abort(403);
    }

    $validated = $request->validate([
        'treatment_type_id' => 'required|integer',
        'room_id' => 'required|integer',
        'date' => 'required|date',
        'time' => 'required|string|max:255',
        'cost' => 'required|numeric|min:0',
        'patient_id' => 'required|integer',
    ], [
        'treatment_type_id.required' => 'Pole typ leczenia jest wymagane.',
        'treatment_type_id.integer' => 'Pole typ leczenia musi być liczbą całkowitą.',
        'room_id.required' => 'Pole pokój jest wymagane.',
        'room_id.integer' => 'Pole pokój musi być liczbą całkowitą.',
        'date.required' => 'Pole data jest wymagane.',
        'date.date' => 'Pole data musi być prawidłową datą.',
        'time.required' => 'Pole czas jest wymagane.',
        'time.string' => 'Pole czas musi być ciągiem znaków.',
        'time.max' => 'Pole czas nie może przekraczać 255 znaków.',
        'cost.required' => 'Pole koszt jest wymagane.',
        'cost.numeric' => 'Pole koszt musi być liczbą.',
        'cost.min' => 'Pole koszt nie może być ujemne.',
        'patient_id.required' => 'Pole pacjent jest wymagane.',
        'patient_id.integer' => 'Pole pacjent musi być liczbą całkowitą.',
    ]);

    $treatmentTypeId = $validated['treatment_type_id'];
    $roomId = $validated['room_id'];
    $date = $validated['date'];
    $time = $validated['time'];
    $cost = $validated['cost'];
    $patientId = $validated['patient_id'];

    try {
        DB::transaction(function () use ($id, $treatmentTypeId, $roomId, $date, $time, $cost, $patientId) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('
                CALL UPDATE_PROCEDURE(:p0, :p1, :p2, :p3, :p4, :p5, :p6)
            ');

            $stmt->bindParam(':p0', $id, PDO::PARAM_INT);
            $stmt->bindParam(':p1', $treatmentTypeId, PDO::PARAM_INT);
            $stmt->bindParam(':p3', $date, PDO::PARAM_STR);
            $stmt->bindParam(':p4', $time, PDO::PARAM_STR);
            $stmt->bindParam(':p2', $roomId, PDO::PARAM_INT);
            $stmt->bindParam(':p5', $cost, PDO::PARAM_INT);
            $stmt->bindParam(':p6', $patientId, PDO::PARAM_INT);

            $stmt->execute();
        });

        return redirect()->route('proceduresIndex')->with('success', 'Procedure successfully updated.');
    } catch (\PDOException $e) {
        if ($e->getCode() == '20003') {
            return redirect()->route('proceduresShow', $id)->withErrors([
                'Błąd' => 'Pacjent już ma zabieg w tym czasie.',
            ]);
        }
        if ($e->getCode() == '20004') {
            return redirect()->route('proceduresShow', $id)->withErrors([
                'Błąd' => 'Sala jest zajęta',
            ]);
        }

        return redirect()->route('proceduresShow', $id)->withErrors([
            'Błąd' => 'Wystąpił błąd'
        ]);
    }
}



    public function destroy($id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        try {
            DB::transaction(function () use ($id) {
                $pdo = DB::getPdo();
                $stmt = $pdo->prepare('CALL DELETE_PROCEDURE(:p0)');
                $stmt->bindParam(':p0', $id, PDO::PARAM_INT);
                $stmt->execute();
            });

            return redirect()->route('proceduresIndex')->with('success', 'Procedure deleted successfully.');
        } catch (\PDOException $e) {
            $errorCode = isset($e->errorInfo[1]) ? $e->errorInfo[1] : null;
            if ($errorCode == -20001) {
                return redirect()->route('proceduresIndex')->withErrors([
                    'Błąd' => 'Nie można usunąć procedury, która jest już przypisana.',
                ]);
            } else {
                return redirect()->route('proceduresIndex')->withErrors([
                    'Błąd' => 'Nie można usunąć zabiegu, zanim nie usunie się przypisań'
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->route('proceduresIndex')->withErrors([
                'Błąd' => 'Error deleting procedure: ' . $e->getMessage(),
            ]);
        }
    }
}
