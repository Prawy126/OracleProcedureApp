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

        DB::transaction(function () use ($treatmentTypeId, $roomId, $date, $time, $cost, $status) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('
                CALL ADD_PROCEDURE(:p0, :p1, TO_TIMESTAMP(:p2, \'YYYY-MM-DD HH24:MI:SS\'), :p3, :p4, :p5)
            ');

            $stmt->bindParam(':p0', $treatmentTypeId, PDO::PARAM_INT);
            $stmt->bindParam(':p1', $roomId, PDO::PARAM_INT);
            $stmt->bindParam(':p2', $date, PDO::PARAM_STR);
            $stmt->bindParam(':p3', $time, PDO::PARAM_STR);
            $stmt->bindParam(':p4', $cost, PDO::PARAM_INT);
            $stmt->bindParam(':p5', $status, PDO::PARAM_INT);

            $stmt->execute();
        });

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

            oci_execute($procedure, OCI_DEFAULT);
            oci_fetch_all($procedure, $result, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);

            if (!empty($result)) {
                $procedure = $result[0];
            }
        });

        if (empty($procedure)) {
            return redirect()->route('proceduresIndex')->with('error', 'Procedure not found.');
        }

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

        DB::transaction(function () use ($id, $treatmentTypeId, $roomId, $date, $time, $cost, $status) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('
                CALL UPDATE_PROCEDURE(:p0, :p1, :p2, :p3, :p4, :p5, :p6)
            ');

            $stmt->bindParam(':p0', $id, PDO::PARAM_INT);
            $stmt->bindParam(':p1', $treatmentTypeId, PDO::PARAM_INT);
            $stmt->bindParam(':p2', $roomId, PDO::PARAM_INT);
            $stmt->bindParam(':p3', $date, PDO::PARAM_STR);
            $stmt->bindParam(':p4', $time, PDO::PARAM_STR);
            $stmt->bindParam(':p5', $cost, PDO::PARAM_INT);
            $stmt->bindParam(':p6', $status, PDO::PARAM_INT);

            $stmt->execute();
        });

        return redirect()->route('proceduresIndex');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('CALL DELETE_PROCEDURE(:p0)');
            $stmt->bindParam(':p0', $id, PDO::PARAM_INT);
            $stmt->execute();
        });

        return redirect()->route('proceduresIndex');
    }
}
