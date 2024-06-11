<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\Medicin;
use App\Models\Patient;
use PDO;

class AssignmentMedicineController extends Controller
{
    public function index()
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        $medicins = Medicin::all(['id', 'name']);
        $patients = Patient::all(['id', 'name', 'surname']);
        $assignments = DB::select('SELECT * FROM ASSIGNMENT_MEDICINES');

        return view('adminElements.medicinAssigment', compact('medicins', 'patients', 'assignments'));
    }

    public function store(Request $request)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        $request->validate([
            'patient_id' => 'required|integer|exists:patients,id',
            'medicin_id' => 'required|integer|exists:medicins,id',
            'dose' => 'required|numeric',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'expiration_date' => 'required|date',
            'availability' => 'required|string|max:1',
        ]);

        DB::statement('CALL ADD_ASSIGNMENT_MEDICINES(?, ?, ?, ?, ?, ?, ?)', [
            $request->input('patient_id'),
            $request->input('medicin_id'),
            $request->input('dose'),
            $request->input('date_start'),
            $request->input('date_end'),
            $request->input('expiration_date'),
            $request->input('availability')
        ]);

        return redirect()->route('assignmentMedicinIndex')->with('success', 'Assignment created successfully.');
    }
    public function edit($id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        $assignmentMedicine = null;

        DB::transaction(function () use ($id, &$assignmentMedicine) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('
                BEGIN
                    GET_ASSIGNMENT_MEDICINES(:p_ID, :p_RESULT);
                END;
            ');

            $stmt->bindParam(':p_ID', $id, PDO::PARAM_INT);
            $stmt->bindParam(':p_RESULT', $resultCursor, PDO::PARAM_STMT);

            $stmt->execute();

            oci_execute($resultCursor, OCI_DEFAULT);
            oci_fetch_all($resultCursor, $result, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);

            if (!empty($result)) {
                $assignmentMedicine = $result[0];
            }
        });

        if ($assignmentMedicine === null) {
            abort(404);
        }

        $patients = Patient::select('id', 'name', 'surname')->get();
        $medicins = Medicin::select('id', 'name')->get();

        return view('adminElements.medicinAssigmentEdit', compact('assignmentMedicine', 'patients', 'medicins'));
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        $request->validate([
            'medicin_id' => 'required|integer|exists:medicins,id',
            'dose' => 'required|numeric',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'expiration_date' => 'required|date',
            'availability' => 'required|string|max:1',
        ]);

        DB::statement('CALL UPDATE_ASSIGNMENT_MEDICINES(?,?, ?, ?, ?, ?, ?, ?)', [
            $id,
            $request->input('patient_id'),
            $request->input('medicin_id'),
            $request->input('dose'),
            $request->input('date_start'),
            $request->input('date_end'),
            $request->input('expiration_date'),
            $request->input('availability')
        ]);

        return redirect()->route('assignmentMedicinIndex')->with('success', 'Assignment updated successfully.');
    }

    public function destroy($id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        DB::statement('CALL DELETE_ASSIGNMENT_MEDICINES(?)', [$id]);

        return redirect()->route('assignmentMedicinIndex')->with('success', 'Assignment deleted successfully.');
    }
}
