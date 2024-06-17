<?php
namespace App\Http\Controllers;

use App\Models\Nurse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use PDO;

class NurseController extends Controller
{
    public function index(Request $request)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        $search = $request->input('search');
        if ($search) {
            $nurses = Nurse::where('name', 'LIKE', "%$search%")
                           ->orWhere('surname', 'LIKE', "%$search%")
                           ->get();
        } else {
            $nurses = Nurse::all();
        }
        $nurses = Nurse::all();
        //dd($nurses);
        $user_ids = DB::select('SELECT * FROM USERS WHERE ACCOUNT_TYPE = ?', [0]);
        //dd($user_ids);
        return view('pielegniarkiTab', [
            'nurses' => $nurses,
            'user_ids' => $user_ids
        ]);
    }

    public function dashboard()
    {
        if (Gate::denies('access-nurse')) {
            abort(403);
        }

        $kontoId = Auth::user()->id;
        $nurseId = DB::table('NURSES')
            ->where('user_id', $kontoId)
            ->value('id');

        if (!$nurseId) {
            return redirect()->route('home')->withErrors(['Błąd' => 'Nie znaleziono przypisanej pielęgniarki.']);
        }

        $proceduresToday = DB::table('PROCEDURES')
            ->whereDate('DATE', '=', today())
            ->count();

        $patientsUnderCare = DB::table('PATIENTS')
            ->where('NURSE_ID', '=', $nurseId)
            ->count();

        $todayProcedures = DB::table('PROCEDURES')
            ->join('TREATMENT_NURSES', 'PROCEDURES.ID', '=', 'TREATMENT_NURSES.PROCEDURE_ID')
            ->join('TREATMENT_TYPES', 'PROCEDURES.TREATMENT_TYPE_ID', '=', 'TREATMENT_TYPES.ID')
            ->join('ROOMS', 'PROCEDURES.ROOM_ID', '=', 'ROOMS.ID')
            ->where('TREATMENT_NURSES.NURSE_ID', '=', $nurseId)
            ->select('PROCEDURES.ID', 'TREATMENT_TYPES.NAME as TREATMENT_TYPE_NAME', 'ROOMS.RNUMBER as ROOM_NUMBER', 'PROCEDURES.DATE', 'PROCEDURES.TIME', 'PROCEDURES.STATUS')
            ->get();

        $patients = DB::table('PATIENTS')
            ->join('ROOMS', 'PATIENTS.ROOM_ID', '=', 'ROOMS.ID')
            ->where('PATIENTS.NURSE_ID', '=', $nurseId)
            ->select('PATIENTS.NAME', 'PATIENTS.SURNAME', 'ROOMS.RNUMBER as ROOM_NUMBER', 'PATIENTS.TIME_VISIT')
            ->get();

        return view('pielegniarka', compact('proceduresToday', 'patientsUnderCare', 'todayProcedures', 'patients'));
    }

    public function store(Request $request)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        DB::transaction(function () use ($request) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare("
                DECLARE
                    v_nurse users_pkg.nurse_rec;
                BEGIN
                    v_nurse.name := :name;
                    v_nurse.surname := :surname;
                    v_nurse.number_license := :number_license;
                    v_nurse.user_id := :user_id;
                    users_pkg.add_nurse(v_nurse);
                END;
            ");

            $name = $request->input('name');
            $surname = $request->input('surname');
            $number_license = $request->input('number_license');
            $user_id = $request->input('user_id');

            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
            $stmt->bindParam(':number_license', $number_license, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
        });

        return redirect()->route('nurseIndex')->with('success', 'Nurse created successfully.');
    }


    public function show($id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        $nurse = null;

        DB::transaction(function () use ($id, &$nurse) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('BEGIN USERS_PKG.get_nurse(:id, :cursor); END;');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Create a cursor reference
            $cursor = null;
            $stmt->bindParam(':cursor', $cursor, PDO::PARAM_STMT);
            $stmt->execute();

            // Use oci functions to handle cursor
            oci_execute($cursor, OCI_DEFAULT);
            oci_fetch_all($cursor, $result, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);

            if (!empty($result)) {
                $nurse = $result[0];
            }
        });

        if (empty($nurse)) {
            return redirect()->route('nurseIndex')->with('error', 'Nurse not found.');
        }

        $user_ids = User::where('account_type', 0)->pluck('id');

        return view('edycjaPielegniarki', compact('nurse','user_ids'));
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'number_license' => 'required|string|max:255',
            'user_id' => 'required|integer',
        ]);

        // Debugging
        Log::info('Request Data:', $request->all());

        DB::transaction(function () use ($validated, $id) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare("
                DECLARE
                    v_nurse USERS_PKG.nurse_rec;
                BEGIN
                    v_nurse.id := :id;
                    v_nurse.name := :name;
                    v_nurse.surname := :surname;
                    v_nurse.number_license := :number_license;
                    v_nurse.user_id := :user_id;
                    USERS_PKG.update_nurse(v_nurse);
                END;
            ");

            // Bind parameters
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $validated['name'], PDO::PARAM_STR);
            $stmt->bindParam(':surname', $validated['surname'], PDO::PARAM_STR);
            $stmt->bindParam(':number_license', $validated['number_license'], PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $validated['user_id'], PDO::PARAM_INT);
            $stmt->execute();
        });

        return redirect()->route('nurseIndex')->with('success', 'Nurse updated successfully.');
    }

    public function destroy($id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        try {
            DB::transaction(function () use ($id) {
                $pdo = DB::getPdo();
                $stmt = $pdo->prepare("
                    BEGIN
                        USERS_PKG.delete_nurse(:id);
                    END;
                ");
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
            });

            return redirect()->route('nurseIndex')->with('success', 'Nurse deleted successfully.');
        } catch (\PDOException $e) {
            // Check if errorInfo is set and contains the error code
            $errorCode = isset($e->errorInfo[1]) ? $e->errorInfo[1] : null;
            //dd($errorCode); jest nullem
            if ($errorCode == 20001) {
                // Custom error handling for nurse assignment
                return redirect()->route('nurseIndex')->withErrors([
                    'Błąd' => 'Nie można usunąć pielęgniarki która jest już przypisana',
                ]);
            } else {
                // General error handling
                return redirect()->route('nurseIndex')->withErrors([
                    'Błąd' => 'Nie można usunąć pielęgniarki która jest już przypisana',
                ]);
            }
        }
    }


}
