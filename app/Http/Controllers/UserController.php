<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'role'     => 'required|in:admin,operator',
        ], [
            'name.required'  => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'role.required'  => 'The role field is required.',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make('temp_password'),
        ]);

        $emailPrefix = substr($request->email, 0, 4);
        $generatedPassword = $emailPrefix . $user->id;

        $user->update([
            'password' => Hash::make($generatedPassword)
        ]);

        return redirect()->route('users.index', ['role' => $request->role])
                         ->with('success', 'Berhasil menambahkan user baru! Password akun ini: ' . $generatedPassword);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:4',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        if (auth()->user()->role == 'operator') {
            return redirect()->back()->with('success', 'Profil Anda berhasil diperbarui!');
        }
        return redirect()->route('users.index', ['role' => $user->role])
                         ->with('success', 'Data user berhasil diperbarui!');
    }

    public function export(Request $request)
    {
        $role = $request->role ?? 'admin';

        $fileName = $role . '-accounts.xlsx';

        return Excel::download(new UserExport($role), $fileName);
    }

    public function resetPassword(User $user)
    {
        $emailPrefix = substr($user->email, 0, 4);
        $generatedPassword = $emailPrefix . $user->id;

        $user->update([
            'password' => Hash::make($generatedPassword)
        ]);

        return redirect()->route('users.index', ['role' => 'operator'])
                         ->with('success', 'Berhasil mereset password! Password baru akun ini adalah: ' . $generatedPassword);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus!');
    }
}
