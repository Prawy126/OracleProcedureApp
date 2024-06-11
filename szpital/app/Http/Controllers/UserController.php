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
            'account_type' => 'required|string|max:255',
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
        if(Gate::denies('access-admin')) {
            abort(403);
        }

        $user = DB::selectOne('SELECT LOGIN, ACCOUNT_TYPE FROM USERS WHERE ID = :id', ['id' => $id]);
        return view('adminElements.accountsEdit', compact('user', 'id'));
    }

    public function update(Request $request, $id)
    {
        if(Gate::denies('access-admin')) {
            abort(403);
        }

        $validated = $request->validate([
            'login' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'account_type' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request, $validated, $id) {
            DB::statement('BEGIN UPDATE_USER(:id, :login, :password, :account_type); END;', [
                'id' => $id,
                'login' => $validated['login'],
                'password' => Hash::make($validated['password']),
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
