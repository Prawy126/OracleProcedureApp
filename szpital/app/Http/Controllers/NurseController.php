<?php
namespace App\Http\Controllers;

use App\Models\Nurse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function store(Request $request)
    {
        $name = $request->input('name');
        $surname = $request->input('surname');
        $number = $request->input('number');
        $userId = $request->input('user_id');

        DB::statement('BEGIN ADD_NURSE(:name, :surname, :number, :userId); END;', [
            'name' => $name,
            'surname' => $surname,
            'number' => $number,
            'userId' => $userId
        ]);

        return redirect()->route('nurseIndex');
    }

    public function show($id)
    {
        $nurse = DB::connection()->getPdo()->prepare('BEGIN GET_NURSE(:id, :nurse); END;');
        $nurse->bindParam(':id', $id);
        $nurse->bindParam(':nurse', $cursor, \PDO::PARAM_STMT);
        $nurse->execute();

        oci_execute($cursor);
        $result = [];
        while ($row = oci_fetch_assoc($cursor)) {
            $result[] = $row;
        }

        oci_free_statement($cursor);

        $nurse = collect($result)->first();

        return view('edycjaPielegniarki', ['nurse' => $nurse]);
    }

    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $surname = $request->input('surname');
        $number = $request->input('number');
        $userId = $request->input('user_id');

        DB::statement('BEGIN UPDATE_NURSE(:id, :name, :surname, :number, :userId); END;', [
            'id' => $id,
            'name' => $name,
            'surname' => $surname,
            'number' => $number,
            'userId' => $userId
        ]);

        return redirect()->route('nurseIndex');
    }

    public function destroy($id)
    {
        DB::statement('BEGIN DELETE_NURSE(:id); END;', [
            'id' => $id
        ]);

        return redirect()->route('nurseIndex');
    }
}
