<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\Medicin;
use App\Models\Patient;

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

        return view('adminElements.medicinAssignment', compact('medicins', 'patients', 'assignments'));
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

        return redirect()->route('assignmentMedicineIndex')->with('success', 'Assignment created successfully.');
    }

    public function edit($patient_id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        $result = DB::select('
            DECLARE
                p_MEDICIN_ID NUMBER;
                p_DOSE NUMBER;
                p_DATE_START DATE;
                p_DATE_END DATE;
                p_EXPIRATION_DATE DATE;
                p_AVAILABILITY CHAR;
            BEGIN
                GET_ASSIGNMENT_MEDICINES(:p_PATIENT_ID, p_MEDICIN_ID, p_DOSE, p_DATE_START, p_DATE_END, p_EXPIRATION_DATE, p_AVAILABILITY);
                :p_MEDICIN_ID := p_MEDICIN_ID;
                :p_DOSE := p_DOSE;
                :p_DATE_START := p_DATE_START;
                :p_DATE_END := p_DATE_END;
                :p_EXPIRATION_DATE := p_EXPIRATION_DATE;
                :p_AVAILABILITY := p_AVAILABILITY;
            END;
        ', [
            'p_PATIENT_ID' => $patient_id,
        ]);

        $assignment = [
            'patient_id' => $patient_id,
            'medicin_id' => $result[0]->p_MEDICIN_ID,
            'dose' => $result[0]->p_DOSE,
            'date_start' => $result[0]->p_DATE_START,
            'date_end' => $result[0]->p_DATE_END,
            'expiration_date' => $result[0]->p_EXPIRATION_DATE,
            'availability' => $result[0]->p_AVAILABILITY
        ];

        $medicins = Medicin::all(['id', 'name']);
        $patients = Patient::all(['id', 'name', 'surname']);

        return view('adminElements.editMedicinAssignment', compact('assignment', 'medicins', 'patients'));
    }

    public function update(Request $request, $patient_id)
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

        DB::statement('CALL UPDATE_ASSIGNMENT_MEDICINES(?, ?, ?, ?, ?, ?, ?)', [
            $patient_id,
            $request->input('medicin_id'),
            $request->input('dose'),
            $request->input('date_start'),
            $request->input('date_end'),
            $request->input('expiration_date'),
            $request->input('availability')
        ]);

        return redirect()->route('assignmentMedicineIndex')->with('success', 'Assignment updated successfully.');
    }

    public function destroy($patient_id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        DB::statement('CALL DELETE_ASSIGNMENT_MEDICINES(?)', [$patient_id]);

        return redirect()->route('assignmentMedicineIndex')->with('success', 'Assignment deleted successfully.');
    }
}
