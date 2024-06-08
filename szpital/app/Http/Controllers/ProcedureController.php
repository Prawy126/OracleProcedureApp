<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class ProcedureController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $procedures = DB::table('PROCEDURES')
            ->where('ID', 'like', "%$search%")
            ->orWhere('TREATMENT_TYPE_ID', 'like', "%$search%")
            ->get();

        return view('zabiegiTab', compact('procedures'));
    }

    public function store(Request $request)
    {
        $treatmentTypeId = $request->input('treatment_type_id');
        $roomId = $request->input('room_id');
        $date = $request->input('date');
        $time = $request->input('time');
        $cost = $request->input('cost');
        $status = $request->input('status');

        DB::statement("CALL ADD_PROCEDURE(?, ?, ?, ?, ?, ?)", [
            $treatmentTypeId, $roomId, $date, $time, $cost, $status
        ]);

        return redirect()->route('proceduresIndex');
    }

    public function show($id)
    {
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

            // Fetch data from cursor
            oci_execute($procedure, OCI_DEFAULT);
            oci_fetch_all($procedure, $result, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);

            if (!empty($result)) {
                $procedure = $result[0];
            }
        });

        if (empty($procedure)) {
            return redirect()->route('proceduresIndex')->with('error', 'Procedure not found.');
        }
        //dd($procedure);
        return view('edycjaZabiegi', compact('procedure'));
    }

    public function update(Request $request, $id)
    {
        $treatmentTypeId = $request->input('treatment_type_id');
        $roomId = $request->input('room_id');
        $date = $request->input('date');
        $time = $request->input('time');
        $cost = $request->input('cost');
        $status = $request->input('status');

        DB::statement("CALL UPDATE_PROCEDURE(?, ?, ?, ?, ?, ?, ?)", [
            $id, $treatmentTypeId, $roomId, $date, $time, $cost, $status
        ]);

        return redirect()->route('proceduresIndex');
    }

    public function destroy($id)
    {
        DB::statement("CALL DELETE_PROCEDURE(?)", [$id]);

        return redirect()->route('proceduresIndex');
    }
}
