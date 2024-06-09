<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Procedure;
use App\Models\TreatmentDoctor;
use Illuminate\Support\Facades\DB;
use PDO;

class TreatmentDoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::select('id', 'name', 'surname')->get();
        $procedures = Procedure::select('id', 'date')->get();
        $treatmentDoctors= DB::select('SELECT * FROM TREATMENTS_DOCTORS');


        return view('adminElements.doctorsTreatments', compact( 'doctors', 'procedures', 'treatmentDoctors'));
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('
                BEGIN
                    ADD_TREATMENTS_DOCTORS(:p_DOCTOR_ID, :p_PROCEDURE_ID);
                END;
            ');

            $doctor_id = $request->input('doctor');
            $procedure_id = $request->input('procedure');

            $stmt->bindParam(':p_DOCTOR_ID', $doctor_id, PDO::PARAM_INT);
            $stmt->bindParam(':p_PROCEDURE_ID', $procedure_id, PDO::PARAM_INT);

            $stmt->execute();
        });


            $doctors = Doctor::all();
            $procedures = Procedure::all();
            $treatmentDoctors = TreatmentDoctor::all();
        return view('adminElements.doctorsTreatments',compact('doctors', 'procedures', 'treatmentDoctors'));
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('
                BEGIN
                    DELETE_TREATMENTS_DOCTORS(:p_ID);
                END;
            ');

            $stmt->bindParam(':p_ID', $id, PDO::PARAM_INT);
            $stmt->execute();
        });
        $doctors = Doctor::all();
            $procedures = Procedure::all();
            $treatmentDoctors = TreatmentDoctor::all();

        return redirect()->route('treatmentDoctor.index',compact('doctors', 'procedures', 'treatmentDoctors'));
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('
                BEGIN
                    UPDATE_TREATMENTS_DOCTORS(:p_ID, :p_NEW_DOCTOR_ID, :p_CREATED_AT, :p_UPDATED_AT);
                END;
            ');

            $newDoctorId = $request->input('doctor');
            $createdAt = $request->input('created_at');
            $updatedAt = now();

            $stmt->bindParam(':p_ID', $id, PDO::PARAM_INT);
            $stmt->bindParam(':p_NEW_DOCTOR_ID', $newDoctorId, PDO::PARAM_INT);
            $stmt->bindParam(':p_CREATED_AT', $createdAt, PDO::PARAM_STR);
            $stmt->bindParam(':p_UPDATED_AT', $updatedAt, PDO::PARAM_STR);

            $stmt->execute();
        });

        $data = [
            'doctors' => Doctor::all(),
            'procedures' => Procedure::all(),
            'treatmentDoctors' => TreatmentDoctor::all(),
        ];
        return view('adminElements.doctorsTreatments', [
            'data' => $data,
        ]);
    }

    public function edit($id)
    {

        $treatmentDoctor = null;

        DB::transaction(function () use ($id, &$treatmentDoctor) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('
                BEGIN
                    GET_TREATMENTS_DOCTORS(:p_DOCTOR_ID, :p_RESULT);
                END;
            ');

            $stmt->bindParam(':p_DOCTOR_ID', $id, PDO::PARAM_INT);
            $stmt->bindParam(':p_RESULT', $resultCursor, PDO::PARAM_STMT);

            $stmt->execute();

            oci_execute($resultCursor, OCI_DEFAULT);
            oci_fetch_all($resultCursor, $result, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);

            if (!empty($result)) {
                $treatmentDoctor = [
                    'doctor_id' => $id,
                    'procedure_id' => $result[0]['PROCEDURE_ID']
                ];
            }
        });



        $doctors = Doctor::select('id', 'name', 'surname')->get();
        $procedures = Procedure::select('id', 'date')->get();

        return view('adminElements.treatmentsDoctorEdit', compact('treatmentDoctor', 'doctors', 'procedures'));
    }


}
