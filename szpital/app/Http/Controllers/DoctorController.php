<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Doctor;
use Illuminate\Support\Facades\Log;
use PDO;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('lekarzeTab', ['doctors' => $doctors]);
    }
    public function dashboard()
    {
        $doctors = Doctor::all();
        return view('lekarz', ['doctors' => $doctors]);
    }

    public function store(Request $request)
    {
        // Debugowanie danych z requesta
        Log::info('Request Data:', $request->all());

        DB::transaction(function () use ($request) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare("
                DECLARE
                    v_doctor users_pkg.doctor_rec;
                BEGIN
                    v_doctor.name := :name;
                    v_doctor.surname := :surname;
                    v_doctor.specialization := :specialization;
                    v_doctor.license_number := :license_number;
                    v_doctor.user_id := :user_id;
                    users_pkg.add_doctor(v_doctor);
                END;
            ");

            // Tworzymy zmienne lokalne dla każdego parametru
            $name = $request->input('name');
            $surname = $request->input('surname');
            $specialization = $request->input('specialization');
            $license_number = $request->input('license_number');
            $user_id = $request->input('user_id');

            // Debugowanie wartości
            Log::info('Bound Parameters:', compact('name', 'surname', 'specialization', 'license_number', 'user_id'));

            // Przypisujemy wartości do parametrów
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
            $stmt->bindParam(':specialization', $specialization, PDO::PARAM_STR);
            $stmt->bindParam(':license_number', $license_number, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
        });

        return redirect()->route('doctorIndex');
    }


    public function edit($id)
    {
        $doctor = null;

        DB::transaction(function () use ($id, &$doctor) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('BEGIN users_pkg.get_doctor(:id, :cursor); END;');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Create a cursor reference
            $cursor = null;
            $stmt->bindParam(':cursor', $cursor, PDO::PARAM_STMT);
            $stmt->execute();

            // Use oci functions to handle cursor
            oci_execute($cursor, OCI_DEFAULT);
            oci_fetch_all($cursor, $result, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);

            if (!empty($result)) {
                $doctor = $result[0];
            }
        });

        if (empty($doctor)) {
            return redirect()->route('doctorIndex')->with('error', 'Doctor not found.');
        }

        return view('edycjaLekarze', compact('doctor'));
    }
    public function update(Request $request, $id)
    {
        // Debugowanie danych z requesta
        Log::info('Request Data:', $request->all());

        DB::transaction(function () use ($request, $id) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare("
                DECLARE
                    v_doctor users_pkg.doctor_rec;
                BEGIN
                    v_doctor.id := :id;
                    v_doctor.name := :name;
                    v_doctor.surname := :surname;
                    v_doctor.specialization := :specialization;
                    v_doctor.license_number := :license_number;
                    v_doctor.user_id := :user_id;
                    users_pkg.update_doctor(v_doctor);
                END;
            ");

            // Tworzymy zmienne lokalne dla każdego parametru
            $name = $request->input('name');
            $surname = $request->input('surname');
            $specialization = $request->input('specialization');
            $license_number = $request->input('license_number');
            $user_id = $request->input('user_id');

            // Debugowanie wartości
            Log::info('Bound Parameters:', compact('id', 'name', 'surname', 'specialization', 'license_number', 'user_id'));

            // Przypisujemy wartości do parametrów
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
            $stmt->bindParam(':specialization', $specialization, PDO::PARAM_STR);
            $stmt->bindParam(':license_number', $license_number, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
        });

        return redirect()->route('doctorIndex');
    }




    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $pdo = DB::getPdo();
                $stmt = $pdo->prepare('BEGIN users_pkg.delete_doctor(:id); END;');
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
            });

            return redirect()->route('doctorIndex')->with('success', 'Doctor deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('doctorIndex')->with('error', 'Error deleting doctor: ' . $e->getMessage());
        }
    }
}
