<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\doctor;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = doctor::all();
        return view('lekarzeTab', [
            'doctors' => $doctors,
        ]);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $zap = 'CREATE OR REPLACE PROCEDURE ADD_DOCTOR(
                p_name IN VARCHAR2,
                p_surname IN VARCHAR2,
                p_specialization IN VARCHAR2,
                p_license_number IN VARCHAR2,
                p_user_id IN NUMBER)
            IS
            BEGIN
                INSERT INTO doctors (name, surname, specialization, license_number, user_id)
                VALUES (p_name, p_surname, p_specialization, p_license_number, p_user_id);
            END;';

            DB::statement($zap, [
                'name' => $request->name,
                'surname' => $request->surname,
                'specialization' => $request->specialization,
                'license_number' => $request->license_number,
                'user_id' => $request->user_id
            ]);
        });
        return redirect()->route('doctorsIndex');
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

        $row = DB::select($zap, [
            'id' => $id,
            'name' => null,
            'surname' => null,
            'specialization' => null,
            'license_number' => null,
            'user_id' => null,

        ]);
        return view('edycjaLekarze', compact('row'));
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function() use ($request, $id) {
            $zap = 'CREATE OR REPLACE PROCEDURE UPDATE_DOCTOR(
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
            END;';

            DB::statement($zap, [
                'id' => $id,
                'name' => $request->name,
                'surname' => $request->surname,
                'specialization' => $request->specialization,
                'license_number' => $request->license_number,
                'user_id' => $request->user_id
            ]);
        });
        return redirect()->route('doctorsIndex');
    }

    public function destroy($id)
    {
        DB::transaction(function() use ($id) {

            $zap = 'CREATE OR REPLACE PROCEDURE DELETE_DOCTOR(
                p_doctor_id IN NUMBER)
            IS
            BEGIN
                DELETE FROM doctors WHERE id = p_doctor_id;
            END;';

            DB::statement($zap, [
                'id' => $id
            ]);
        });
        return redirect()->route('doctorsIndex');
    }
}
