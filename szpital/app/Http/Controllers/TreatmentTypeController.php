<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class TreatmentTypeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $treatmentTypes = DB::select('SELECT * FROM TREATMENT_TYPES WHERE NAME LIKE ?', ['%' . $search . '%']);
        return view('typZabiegowTab', compact('treatmentTypes'));
    }

    public function create()
    {
        return view('treatmentTypes.create');
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('
                BEGIN
                    ADD_TREATMENT_TYPE(
                        :p_NAME,
                        :p_DESCRIPTION,
                        :p_RECOMMENDATIONS_BEFORE_SURGERY,
                        :p_RECOMMENDATIONS_AFTER_SURGERY
                    );
                END;
            ');

            $name = $request->input('name');
            $description = $request->input('description');
            $recommendations_before_surgery = $request->input('recommendations_before_surgery');
            $recommendations_after_surgery = $request->input('recommendations_after_surgery');

            $stmt->bindParam(':p_NAME', $name, PDO::PARAM_STR);
            $stmt->bindParam(':p_DESCRIPTION', $description, PDO::PARAM_STR);
            $stmt->bindParam(':p_RECOMMENDATIONS_BEFORE_SURGERY', $recommendations_before_surgery, PDO::PARAM_STR);
            $stmt->bindParam(':p_RECOMMENDATIONS_AFTER_SURGERY', $recommendations_after_surgery, PDO::PARAM_STR);

            $stmt->execute();
        });

        return redirect()->route('treatmentTypes.index')->with('success', 'Treatment Type added successfully');
    }

    public function edit($id)
    {
        $treatmentType = null;

        DB::transaction(function () use ($id, &$treatmentType) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('
                DECLARE
                    p_NAME VARCHAR2(100);
                    p_DESCRIPTION CLOB;
                    p_RECOMMENDATIONS_BEFORE_SURGERY CLOB;
                    p_RECOMMENDATIONS_AFTER_SURGERY CLOB;
                    p_CREATED_AT TIMESTAMP;
                    p_UPDATED_AT TIMESTAMP;
                BEGIN
                    GET_TREATMENT_TYPE(
                        :p_ID,
                        p_NAME,
                        p_DESCRIPTION,
                        p_RECOMMENDATIONS_BEFORE_SURGERY,
                        p_RECOMMENDATIONS_AFTER_SURGERY,
                        p_CREATED_AT,
                        p_UPDATED_AT
                    );

                    :p_NAME := p_NAME;
                    :p_DESCRIPTION := p_DESCRIPTION;
                    :p_RECOMMENDATIONS_BEFORE_SURGERY := p_RECOMMENDATIONS_BEFORE_SURGERY;
                    :p_RECOMMENDATIONS_AFTER_SURGERY := p_RECOMMENDATIONS_AFTER_SURGERY;
                    :p_CREATED_AT := p_CREATED_AT;
                    :p_UPDATED_AT := p_UPDATED_AT;
                END;
            ');

            $stmt->bindParam(':p_ID', $id, PDO::PARAM_INT);

            // Bind output parameters
            $stmt->bindParam(':p_NAME', $name, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 100);
            $stmt->bindParam(':p_DESCRIPTION', $description, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);
            $stmt->bindParam(':p_RECOMMENDATIONS_BEFORE_SURGERY', $recommendations_before_surgery, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);
            $stmt->bindParam(':p_RECOMMENDATIONS_AFTER_SURGERY', $recommendations_after_surgery, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);
            $stmt->bindParam(':p_CREATED_AT', $created_at, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':p_UPDATED_AT', $updated_at, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);

            $stmt->execute();

            $treatmentType = [
                'ID' => $id,
                'NAME' => $name,
                'DESCRIPTION' => $description,
                'RECOMMENDATIONS_BEFORE_SURGERY' => $recommendations_before_surgery,
                'RECOMMENDATIONS_AFTER_SURGERY' => $recommendations_after_surgery,
                'CREATED_AT' => $created_at,
                'UPDATED_AT' => $updated_at
            ];
        });

        if ($treatmentType === null) {
            return redirect()->route('treatmentTypes.index')->with('error', 'Treatment Type not found.');
        }

        return view('edycjaTypyZabiegow', compact('treatmentType'));
    }
    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('
                BEGIN
                    UPDATE_TREATMENT_TYPE(
                        :p_ID,
                        :p_NAME,
                        :p_DESCRIPTION,
                        :p_RECOMMENDATIONS_BEFORE_SURGERY,
                        :p_RECOMMENDATIONS_AFTER_SURGERY
                    );
                END;
            ');

            $name = $request->input('name');
            $description = $request->input('description');
            $recommendations_before_surgery = $request->input('recommendations_before_surgery');
            $recommendations_after_surgery = $request->input('recommendations_after_surgery');

            $stmt->bindParam(':p_ID', $id, PDO::PARAM_INT);
            $stmt->bindParam(':p_NAME', $name, PDO::PARAM_STR);
            $stmt->bindParam(':p_DESCRIPTION', $description, PDO::PARAM_STR);
            $stmt->bindParam(':p_RECOMMENDATIONS_BEFORE_SURGERY', $recommendations_before_surgery, PDO::PARAM_STR);
            $stmt->bindParam(':p_RECOMMENDATIONS_AFTER_SURGERY', $recommendations_after_surgery, PDO::PARAM_STR);

            $stmt->execute();
        });

        return redirect()->route('treatmentTypes.index')->with('success', 'Treatment Type updated successfully');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare('
                BEGIN
                    DELETE_TREATMENT_TYPE(:p_ID);
                END;
            ');

            $stmt->bindParam(':p_ID', $id, PDO::PARAM_INT);
            $stmt->execute();
        });

        return redirect()->route('treatmentTypes.index')->with('success', 'Treatment Type deleted successfully');
    }
}
