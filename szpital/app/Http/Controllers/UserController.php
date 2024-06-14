<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        if(Gate::denies('access-admin')) {
            abort(403);
        }

        $users = DB::select('SELECT ID, LOGIN, ACCOUNT_TYPE FROM USERS');
        return view('adminElements.accounts', ['users' => $users]);
    }


    public function store(Request $request)
    {
        if(Gate::denies('access-admin')) {
            abort(403);
        }

        $validated = $request->validate([
            'login' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'account_type' => 'required|integer|max:255',
        ]);

        DB::transaction(function () use ($request, $validated) {
            DB::statement('BEGIN CREATE_USER( :login, :password, :account_type); END;', [
                'login' => $validated['login'],
                'password' => Hash::make($validated['password']),
                'account_type' => $validated['account_type'],
            ]);
        });

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        // Połączenie PDO z bazy danych
        $pdo = DB::getPdo();

        // Przygotowanie zapytania
        $stmt = $pdo->prepare('BEGIN GET_USER(:id, :login, :account_type); END;');

        // Definiowanie parametrów IN i OUT
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->bindParam(':login', $login, \PDO::PARAM_STR| \PDO::PARAM_INPUT_OUTPUT, 50); // dostosuj długość zgodnie z rzeczywistością
        $stmt->bindParam(':account_type', $account_type, \PDO::PARAM_INT | \PDO::PARAM_INPUT_OUTPUT);

        // Wykonanie procedury
        $stmt->execute();

        // Tworzenie obiektu użytkownika z wyników procedury
        $user = (object) [
            'login' => $login,
            'account_type' => $account_type,
        ];


        return view('adminElements.accountsEdit', compact('user', 'id'));
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        $validated = $request->validate([
            'login' => 'required|string|max:255',
            'password' => 'nullable|string|max:255',
            'account_type' => 'required|integer',
        ]);

        // Pobranie aktualnych danych użytkownika
        $user = DB::table('users')->where('id', $id)->first();

        // Sprawdzenie, czy hasło zostało podane
        $password = $user->password; // Użyj istniejącego hasła jako domyślnego
        if (!empty($validated['password'])) {
            $password = Hash::make($validated['password']); // Zaktualizuj hasło, jeśli podano nowe
        }

        DB::transaction(function () use ($request, $validated, $id, $password) {
            DB::statement('BEGIN UPDATE_USER(:id, :login, :password, :account_type); END;', [
                'id' => $id,
                'login' => $validated['login'],
                'password' => $password,
                'account_type' => $validated['account_type'],
            ]);
        });

        $users = DB::table('users')->get();

        return view('adminElements.accounts', ['users' => $users]);
    }



    public function destroy($id)
    {
        if(Gate::denies('access-admin')) {
            abort(403);
        }

        DB::transaction(function () use ($id) {
            DB::statement('BEGIN DELETE_USER(:id); END;', ['id' => $id]);
        });

        $users = DB::table('users')->get();
        return view('adminElements.accounts', ['users' => $users]);
    }
}
