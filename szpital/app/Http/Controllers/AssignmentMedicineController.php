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
        if (Gate::denies('access-admin') && Gate::denies('access-doctor')) {
            abort(403);
        }


        $medicins = Medicin::all(['id', 'name']);
        $patients = Patient::all(['id', 'name', 'surname']);

        // Modyfikacja zapytania SQL, aby sformatować daty bez godziny
        $assignments = DB::select("
            SELECT
                ID,
                PATIENT_ID,
                MEDICIN_ID,
                DOSE,
                TO_CHAR(DATE_START, 'YYYY-MM-DD') AS DATE_START,
                TO_CHAR(DATE_END, 'YYYY-MM-DD') AS DATE_END,
                TO_CHAR(EXPIRATION_DATE, 'YYYY-MM-DD') AS EXPIRATION_DATE,
                AVAILABILITY
            FROM ASSIGNMENT_MEDICINES
        ");

        return view('adminElements.medicinAssigment', compact('medicins', 'patients', 'assignments'));
    }

    public function store(Request $request)
    {
        if (Gate::denies('access-admin') && Gate::denies('access-doctor')) {
            abort(403);
        }


        $validated = $request->validate([
            'patient_id' => 'required|integer|exists:patients,id',
            'medicin_id' => 'required|integer|exists:medicins,id',
            'dose' => 'required|numeric|min:0',
            'date_start' => 'required|date',
            'date_end' => 'required|date|after_or_equal:date_start',
            'expiration_date' => 'required|date|after_or_equal:date_end',
            'availability' => 'required|string|max:1',
        ], [
            'patient_id.required' => 'Pole pacjent jest wymagane.',
            'patient_id.integer' => 'Pole pacjent musi być liczbą całkowitą.',
            'patient_id.exists' => 'Wybrany pacjent nie istnieje.',
            'medicin_id.required' => 'Pole lek jest wymagane.',
            'medicin_id.integer' => 'Pole lek musi być liczbą całkowitą.',
            'medicin_id.exists' => 'Wybrany lek nie istnieje.',
            'dose.required' => 'Pole dawka jest wymagane.',
            'dose.numeric' => 'Pole dawka musi być liczbą.',
            'dose.min'=>"Dawka nie może być ujemna",
            'date_start.required' => 'Pole data rozpoczęcia jest wymagane.',
            'date_start.date' => 'Pole data rozpoczęcia musi być prawidłową datą.',
            'date_end.required' => 'Pole data zakończenia jest wymagane.',
            'date_end.date' => 'Pole data zakończenia musi być prawidłową datą.',
            'date_end.after_or_equal' => 'Pole data zakończenia musi być późniejsze lub równe polu data rozpoczęcia.',
            'expiration_date.required' => 'Pole data ważności jest wymagane.',
            'expiration_date.date' => 'Pole data ważności musi być prawidłową datą.',
            'expiration_date.after_or_equal' => 'Pole data ważności musi być późniejsze lub równe polu data zakończenia.',
            'availability.required' => 'Pole dostępność jest wymagane.',
            'availability.string' => 'Pole dostępność musi być ciągiem znaków.',
            'availability.max' => 'Pole dostępność nie może przekraczać 1 znaku.',
        ]);

        DB::statement('CALL ADD_ASSIGNMENT_MEDICINES(?, ?, ?, ?, ?, ?, ?)', [
            $validated['patient_id'],
            $validated['medicin_id'],
            $validated['dose'],
            $validated['date_start'],
            $validated['date_end'],
            $validated['expiration_date'],
            $validated['availability']
        ]);

        return redirect()->route('assignmentMedicinIndex')->with('success', 'Przypisanie utworzone pomyślnie.');
    }

    public function edit($id)
    {
        if (Gate::denies('access-admin') && Gate::denies('access-doctor')) {
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
                // Formatowanie dat
                $assignmentMedicine['DATE_START'] = date('Y-m-d', strtotime($assignmentMedicine['DATE_START']));
                $assignmentMedicine['DATE_END'] = date('Y-m-d', strtotime($assignmentMedicine['DATE_END']));
                $assignmentMedicine['EXPIRATION_DATE'] = date('Y-m-d', strtotime($assignmentMedicine['EXPIRATION_DATE']));
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
        if (Gate::denies('access-admin') && Gate::denies('access-doctor')) {
            abort(403);
        }


        $validated = $request->validate([
            'patient_id' => 'required|integer|exists:patients,id',
            'medicin_id' => 'required|integer|exists:medicins,id',
            'dose' => 'required|numeric|min:0',
            'date_start' => 'required|date',
            'date_end' => 'required|date|after_or_equal:date_start',
            'expiration_date' => 'required|date|after_or_equal:date_end',
            'availability' => 'required|string|max:1',
        ], [
            'medicin_id.required' => 'Pole lek jest wymagane.',
            'medicin_id.integer' => 'Pole lek musi być liczbą całkowitą.',
            'medicin_id.exists' => 'Wybrany lek nie istnieje.',
            'dose.required' => 'Pole dawka jest wymagane.',
            'dose.numeric' => 'Pole dawka musi być liczbą.',
            'dose.min'=>"Dawka nie może być ujemna",
            'date_start.required' => 'Pole data rozpoczęcia jest wymagane.',
            'date_start.date' => 'Pole data rozpoczęcia musi być prawidłową datą.',
            'date_end.required' => 'Pole data zakończenia jest wymagane.',
            'date_end.date' => 'Pole data zakończenia musi być prawidłową datą.',
            'date_end.after_or_equal' => 'Pole data zakończenia musi być późniejsze lub równe polu data rozpoczęcia.',
            'expiration_date.required' => 'Pole data ważności jest wymagane.',
            'expiration_date.date' => 'Pole data ważności musi być prawidłową datą.',
            'expiration_date.after_or_equal' => 'Pole data ważności musi być późniejsze lub równe polu data zakończenia.',
            'availability.required' => 'Pole dostępność jest wymagane.',
            'availability.string' => 'Pole dostępność musi być ciągiem znaków.',
            'availability.max' => 'Pole dostępność nie może przekraczać 1 znaku.',
        ]);
       // dd($request);
        DB::statement('CALL UPDATE_ASSIGNMENT_MEDICINES(?, ?, ?, ?, ?, ?, ?, ?)', [
            $id,
            $validated['patient_id'],
            $validated['medicin_id'],
            $validated['dose'],
            $validated['date_start'],
            $validated['date_end'],
            $validated['expiration_date'],
            $validated['availability']
        ]);

        return redirect()->route('assignmentMedicinIndex')->with('success', 'Przypisanie zaktualizowane pomyślnie.');
    }

    public function destroy($id)
    {
        if (Gate::denies('access-admin') && Gate::denies('access-doctor')) {
            abort(403);
        }


        DB::statement('CALL DELETE_ASSIGNMENT_MEDICINES(?)', [$id]);

        return redirect()->route('assignmentMedicinIndex')->with('success', 'Przypisanie usunięte pomyślnie.');
    }
}
