<?php
namespace App\Http\Controllers;

use App\Models\Medicin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use Illuminate\Support\Facades\Gate;

class MedicinController extends Controller
{
    public function index()
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        $medicines = Medicin::all();
        return view('lekiTab', [
            'medicines' => $medicines,
        ]);
    }

    public function store(Request $request)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'instruction' => 'required|string',
            'warehouse_quantity' => 'required|integer|min:0',
            'drug_category' => 'required|string|max:200',
            'price' => 'required|numeric|min:0',
            'dose_unit' => 'required|string|max:200',
        ], [
            'name.required' => 'Pole nazwa jest wymagane.',
            'name.string' => 'Pole nazwa musi być ciągiem znaków.',
            'name.max' => 'Pole nazwa nie może przekraczać 200 znaków.',
            'instruction.required' => 'Pole instrukcja jest wymagane.',
            'instruction.string' => 'Pole instrukcja musi być ciągiem znaków.',
            'warehouse_quantity.required' => 'Pole ilość w magazynie jest wymagane.',
            'warehouse_quantity.integer' => 'Pole ilość w magazynie musi być liczbą całkowitą.',
            'warehouse_quantity.min' => 'Pole ilość w magazynie nie może być ujemne.',
            'drug_category.required' => 'Pole kategoria leku jest wymagane.',
            'drug_category.string' => 'Pole kategoria leku musi być ciągiem znaków.',
            'drug_category.max' => 'Pole kategoria leku nie może przekraczać 200 znaków.',
            'price.required' => 'Pole cena jest wymagane.',
            'price.numeric' => 'Pole cena musi być liczbą.',
            'price.min' => 'Pole cena nie może być ujemne.',
            'dose_unit.required' => 'Pole jednostka dawkowania jest wymagane.',
            'dose_unit.string' => 'Pole jednostka dawkowania musi być ciągiem znaków.',
            'dose_unit.max' => 'Pole jednostka dawkowania nie może przekraczać 200 znaków.',
        ]);

        DB::transaction(function () use ($validated) {
            $pdo = DB::getPdo();

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

            $stmt->bindParam(':name', $validated['name'], PDO::PARAM_STR);
            $stmt->bindParam(':instruction', $validated['instruction'], PDO::PARAM_STR);
            $stmt->bindParam(':warehouse_quantity', $validated['warehouse_quantity'], PDO::PARAM_INT);
            $stmt->bindParam(':drug_category', $validated['drug_category'], PDO::PARAM_STR);
            $stmt->bindParam(':price', $validated['price'], PDO::PARAM_INT);
            $stmt->bindParam(':dose_unit', $validated['dose_unit'], PDO::PARAM_STR);
            $stmt->execute();
        });

        return redirect()->route('medicinIndex')->with('success', 'Lek dodany pomyślnie.');
    }

    public function edit($id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

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
            return redirect()->route('medicinIndex')->with('error', 'Nie znaleziono leku.');
        }

        return view('edycjaLeki', compact('medicin'));
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'instruction' => 'required|string',
            'warehouse_quantity' => 'required|integer|min:0',
            'drug_category' => 'required|string|max:200',
            'price' => 'required|numeric|min:0',
            'dose_unit' => 'required|string|max:200',
        ], [
            'name.required' => 'Pole nazwa jest wymagane.',
            'name.string' => 'Pole nazwa musi być ciągiem znaków.',
            'name.max' => 'Pole nazwa nie może przekraczać 200 znaków.',
            'instruction.required' => 'Pole instrukcja jest wymagane.',
            'instruction.string' => 'Pole instrukcja musi być ciągiem znaków.',
            'warehouse_quantity.required' => 'Pole ilość w magazynie jest wymagane.',
            'warehouse_quantity.integer' => 'Pole ilość w magazynie musi być liczbą całkowitą.',
            'warehouse_quantity.min' => 'Pole ilość w magazynie nie może być ujemne.',
            'drug_category.required' => 'Pole kategoria leku jest wymagane.',
            'drug_category.string' => 'Pole kategoria leku musi być ciągiem znaków.',
            'drug_category.max' => 'Pole kategoria leku nie może przekraczać 200 znaków.',
            'price.required' => 'Pole cena jest wymagane.',
            'price.numeric' => 'Pole cena musi być liczbą.',
            'price.min' => 'Pole cena nie może być ujemne.',
            'dose_unit.required' => 'Pole jednostka dawkowania jest wymagane.',
            'dose_unit.string' => 'Pole jednostka dawkowania musi być ciągiem znaków.',
            'dose_unit.max' => 'Pole jednostka dawkowania nie może przekraczać 200 znaków.',
        ]);

        DB::transaction(function () use ($validated, $id) {
            $pdo = DB::getPdo();

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
            $stmt->bindParam(':name', $validated['name'], PDO::PARAM_STR);
            $stmt->bindParam(':instruction', $validated['instruction'], PDO::PARAM_STR);
            $stmt->bindParam(':warehouse_quantity', $validated['warehouse_quantity'], PDO::PARAM_INT);
            $stmt->bindParam(':drug_category', $validated['drug_category'], PDO::PARAM_STR);
            $stmt->bindParam(':price', $validated['price'], PDO::PARAM_INT);
            $stmt->bindParam(':dose_unit', $validated['dose_unit'], PDO::PARAM_STR);
            $stmt->execute();
        });

        return redirect()->route('medicinIndex')->with('success', 'Lek zaktualizowany pomyślnie.');
    }

    public function destroy($id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        try {
            DB::transaction(function () use ($id) {
                $pdo = DB::getPdo();
                $stmt = $pdo->prepare('BEGIN szpital.delete_medicin(:id); END;');
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
            });

            return redirect()->route('medicinIndex')->with('success', 'Lek usunięty pomyślnie.');
        } catch (\Exception $e) {
            return redirect()->route('medicinIndex')->with('error', 'Błąd przy usuwaniu leku: ' . $e->getMessage());
        }
    }
}
