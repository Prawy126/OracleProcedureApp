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
            DB::statement('
                CREATE OR REPLACE PROCEDURE ADD_DOCTOR(
                    p_name IN VARCHAR2,
                    p_surname IN VARCHAR2,
                    p_specialization IN VARCHAR2,
                    p_license_number IN VARCHAR2,
                    p_user_id IN NUMBER)
                IS
                BEGIN
                    INSERT INTO doctors (name, surname, specialization, license_number, user_id)
                    VALUES (p_name, p_surname, p_specialization, p_license_number, p_user_id);
                END;'
            );

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
        $zap = 'CREATE OR REPLACE PROCEDURE GET_DOCTOR(
            p_doctor_id IN NUMBER,
            p_doctor OUT SYS_REFCURSOR)
        IS
        BEGIN
            OPEN p_doctor FOR
            SELECT * FROM doctors WHERE id = p_doctor_id;
        END;';

        DB::statement($zap);

        $doctor = DB::select('BEGIN GET_DOCTOR(:id, :doctor); END;', [
            'id' => $id,
            'doctor' => null
        ]);

        return view('edycjaLekarze', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function() use ($request, $id) {
            DB::statement('
                CREATE OR REPLACE PROCEDURE UPDATE_DOCTOR(
                    p_doctor_id IN NUMBER,
                    p_name IN VARCHAR2,
                    p_surname IN VARCHAR2,
                    p_specialization IN VARCHAR2,
                    p_license_number IN VARCHAR2,
                    p_user_id IN NUMBER)
                IS
                BEGIN
                    UPDATE doctors
                    SET name = p_name,
                        surname = p_surname,
                        specialization = p_specialization,
                        license_number = p_license_number,
                        user_id = p_user_id
                    WHERE id = p_doctor_id;
                END;'
            );

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
                DB::statement('
                    CREATE OR REPLACE PROCEDURE DELETE_DOCTOR(
                        p_doctor_id IN NUMBER)
                    IS
                    BEGIN
                        DELETE FROM doctors WHERE id = p_doctor_id;
                    END;'
                );

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
