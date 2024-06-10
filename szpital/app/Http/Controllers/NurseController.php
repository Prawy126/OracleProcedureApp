<?php
namespace App\Http\Controllers;

use App\Models\Nurse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDO;

class NurseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $nurses = Nurse::where('name', 'LIKE', "%$search%")
                           ->orWhere('surname', 'LIKE', "%$search%")
                           ->get();
        } else {
            $nurses = Nurse::all();
        }

        return view('pielegniarkiTab', [
            'nurses' => $nurses,
        ]);
    }

    public function dashboard()
    {
        return view('pielegniarka');
    }

    public function store(Request $request)
    {
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

        return view('edycjaPielegniarki', ['nurse' => $nurse]);
    }

    public function update(Request $request, $id)
    {
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
    }
}
