<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Doctor;
use Exception;
use Illuminate\Support\Facades\Log;
use PDO;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('lekarzeTab', ['doctors' => $doctors]);
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
        $doctor = null;

        DB::getPdo()->beginTransaction();
        $stmt = DB::getPdo()->prepare('BEGIN GET_DOCTOR(:id, :cursor); END;');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':cursor', $doctor, PDO::PARAM_STMT);
        $stmt->execute();

        oci_execute($doctor, OCI_DEFAULT);
        oci_fetch_all($doctor, $result, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);
        DB::getPdo()->commit();

        if (empty($result)) {
            return redirect()->route('doctorIndex')->with('error', 'Doctor not found.');
        }

        $doctor = $result[0]; // Przypisanie pierwszego wiersza wyników do zmiennej $doctor
        //dd($doctor);
        return view('edycjaLekarze', compact('doctor'));

        }
        /*$doctor = Doctor::find($id); // lub inne zapytanie
        dd($doctor); // Debugging

        return view('edycjaLekarze',compact('doctor'));
        dd($doctor);*/


    public function update(Request $request, $id)
    {
        DB::transaction(function() use ($request, $id) {
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
                DB::statement('BEGIN DELETE_DOCTOR(:id); END;', ['id' => $id]);
            });

            return redirect()->route('doctorIndex')->with('success', 'Doctor deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('doctorIndex')->with('error', 'Error deleting doctor: ' . $e->getMessage());
        }
    }
}
