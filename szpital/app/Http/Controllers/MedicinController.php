<?php
namespace App\Http\Controllers;

use App\Models\medicin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class MedicinController extends Controller
{
    public function index()
    {
        $medicines = medicin::all();
        return view('lekiTab', [
            'medicines' => $medicines,
        ]);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            DB::statement('BEGIN ADD_MEDICINE(:name, :instruction, :warehouse_quantity, :drug_category, :price, :dose_unit); END;', [
                'name' => $request->input('name'),
                'instruction' => $request->input('instruction'),
                'warehouse_quantity' => $request->input('warehouse_quantity'),
                'drug_category' => $request->input('drug_category'),
                'price' => $request->input('price'),
                'dose_unit' => $request->input('dose_unit')
            ]);
        });

        return redirect()->route('medicinIndex');
    }

    public function edit($id)
    {
        $medicin = null;

        DB::getPdo()->beginTransaction();
        $stmt = DB::getPdo()->prepare('BEGIN GET_MEDICIN(:id, :cursor); END;');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':cursor', $medicin, PDO::PARAM_STMT);
        $stmt->execute();

        oci_execute($medicin, OCI_DEFAULT);
        oci_fetch_all($medicin, $result, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);
        DB::getPdo()->commit();

        if (empty($result)) {
            return redirect()->route('medicinIndex');
        }

        $medicin = $result[0];
        return view('edycjaLeki', compact('medicin'));
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function() use ($request, $id) {
            DB::statement('UPDATE_MEDICIN(:name, :instruction, :warehouse_quantity, :drug_category, :price, :dose_unit); END;', [
                'name' => $request->input('name'),
                'instruction' => $request->input('instruction'),
                'warehouse_quantity' => $request->input('warehouse_quantity'),
                'drug_category' => $request->input('drug_category'),
                'price' => $request->input('price'),
                'dose_unit' => $request->input('dose_unit')
            ]);
        });

        return redirect()->route('medicinIndex');
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function() use ($id) {
                DB::statement('BEGIN DELETE_MEDICIN(:id); END;', ['id' => $id]);
            });

            return redirect()->route('medicinIndex');
        } catch (\Exception $e) {
            return redirect()->route('medicinIndex');
        }
    }
}
