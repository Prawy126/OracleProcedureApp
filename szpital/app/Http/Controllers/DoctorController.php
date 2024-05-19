<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Doctor;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('lekarzeTab', [
            'doctors' => $doctors,
        ]);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            DB::statement('BEGIN ADD_DOCTOR(:name, :surname, :specialization, :license_number, :user_id); END;', [
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'specialization' => $request->input('specialization'),
                'license_number' => $request->input('license_number'),
                'user_id' => $request->input('user_id')
            ]);
        });

        return redirect()->route('doctorIndex');
    }

    public function edit($id)
    {
        // Wywołanie istniejącej procedury składowanej
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare("BEGIN GET_DOCTOR(:id, :doctor); END;");

        // Rejestracja zmiennych wejściowych i wyjściowych
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':doctor', $doctorCursor, PDO::PARAM_STMT);

        // Wykonanie procedury
        $stmt->execute();

        // Fetchowanie danych z kursora
        oci_execute($doctorCursor, OCI_DEFAULT);
        $doctor = [];
        while ($row = oci_fetch_assoc($doctorCursor)) {
            $doctor[] = $row;
        }

        // Zamknięcie kursora
        oci_free_statement($doctorCursor);

        return view('edycjaLekarze', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function() use ($request, $id) {
            // Wywołanie istniejącej procedury składowanej
            DB::statement('BEGIN UPDATE_DOCTOR(:id, :name, :surname, :specialization, :license_number, :user_id); END;', [
                'id' => $id,
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'specialization' => $request->input('specialization'),
                'license_number' => $request->input('license_number'),
                'user_id' => $request->input('user_id')
            ]);
        });

        return redirect()->route('doctorIndex');
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function() use ($id) {
                // Wywołanie istniejącej procedury składowanej
                DB::statement('BEGIN DELETE_DOCTOR(:id); END;', [
                    'id' => $id
                ]);
            });

            return redirect()->route('doctorIndex')->with('success', 'Doctor deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('doctorIndex')->with('error', 'Error deleting doctor: ' . $e->getMessage());
        }
    }
}
