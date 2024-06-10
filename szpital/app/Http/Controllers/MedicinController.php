<?php
namespace App\Http\Controllers;

use App\Models\Medicin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use Illuminate\Support\Facades\Log;

class MedicinController extends Controller
{
    public function index()
    {
        $medicines = Medicin::all();
        return view('lekiTab', [
            'medicines' => $medicines,
        ]);
    }

    public function store(Request $request)
    {
        // Debugowanie danych z requesta
        Log::info('Request Data:', $request->all());

        DB::transaction(function () use ($request) {
            $pdo = DB::getPdo();

            $name = $request->input('name');
            $instruction = $request->input('instruction');
            $warehouse_quantity = $request->input('warehouse_quantity');
            $drug_category = $request->input('drug_category');
            $price = $request->input('price');
            $dose_unit = $request->input('dose_unit');

            $stmt = $pdo->prepare("
                DECLARE
                    v_name VARCHAR2(200);
                    v_instruction CLOB;
                    v_warehouse_quantity NUMBER;
                    v_drug_category VARCHAR2(200);
                    v_price NUMBER;
                    v_dose_unit VARCHAR2(200);
                BEGIN
                    v_name := :name;
                    v_instruction := :instruction;
                    v_warehouse_quantity := :warehouse_quantity;
                    v_drug_category := :drug_category;
                    v_price := :price;
                    v_dose_unit := :dose_unit;
                    szpital.add_medicine(v_name, v_instruction, v_warehouse_quantity, v_drug_category, v_price, v_dose_unit);
                END;
            ");

            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':instruction', $instruction, PDO::PARAM_STR);
            $stmt->bindParam(':warehouse_quantity', $warehouse_quantity, PDO::PARAM_INT);
            $stmt->bindParam(':drug_category', $drug_category, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_INT);
            $stmt->bindParam(':dose_unit', $dose_unit, PDO::PARAM_STR);
            $stmt->execute();
        });

        return redirect()->route('medicinIndex');
    }

    public function edit($id)
    {
        $medicin = null;

        DB::transaction(function () use ($id, &$medicin) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('BEGIN szpital.get_medicin(:id, :cursor); END;');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $cursor = null;
            $stmt->bindParam(':cursor', $cursor, PDO::PARAM_STMT);
            $stmt->execute();

            oci_execute($cursor, OCI_DEFAULT);
            oci_fetch_all($cursor, $result, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);

            if (!empty($result)) {
                $medicin = $result[0];
            }
        });

        if (empty($medicin)) {
            return redirect()->route('medicinIndex')->with('error', 'Medicin not found.');
        }

        return view('edycjaLeki', compact('medicin'));
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $pdo = DB::getPdo();

            $name = $request->input('name');
            $instruction = $request->input('instruction');
            $warehouse_quantity = $request->input('warehouse_quantity');
            $drug_category = $request->input('drug_category');
            $price = $request->input('price');
            $dose_unit = $request->input('dose_unit');

            $stmt = $pdo->prepare("
                DECLARE
                    v_medicin_id NUMBER;
                    v_name VARCHAR2(200);
                    v_instruction CLOB;
                    v_warehouse_quantity NUMBER;
                    v_drug_category VARCHAR2(200);
                    v_price NUMBER;
                    v_dose_unit VARCHAR2(200);
                BEGIN
                    v_medicin_id := :id;
                    v_name := :name;
                    v_instruction := :instruction;
                    v_warehouse_quantity := :warehouse_quantity;
                    v_drug_category := :drug_category;
                    v_price := :price;
                    v_dose_unit := :dose_unit;
                    szpital.update_medicin(v_medicin_id, v_name, v_instruction, v_warehouse_quantity, v_drug_category, v_price, v_dose_unit);
                END;
            ");

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':instruction', $instruction, PDO::PARAM_STR);
            $stmt->bindParam(':warehouse_quantity', $warehouse_quantity, PDO::PARAM_INT);
            $stmt->bindParam(':drug_category', $drug_category, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_INT);
            $stmt->bindParam(':dose_unit', $dose_unit, PDO::PARAM_STR);
            $stmt->execute();
        });

        return redirect()->route('medicinIndex');
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $pdo = DB::getPdo();
                $stmt = $pdo->prepare('BEGIN szpital.delete_medicin(:id); END;');
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
            });

            return redirect()->route('medicinIndex')->with('success', 'Medicin deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('medicinIndex')->with('error', 'Error deleting medicin: ' . $e->getMessage());
        }
    }
}
