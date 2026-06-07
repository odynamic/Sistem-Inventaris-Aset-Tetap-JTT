<?php

namespace App\Http\Controllers\Domains\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $query = User::orderBy('id','desc');

        if ($search) {
            $query->where('name','like',"%$search%")
                  ->orWhere('email','like',"%$search%");
        }

        return view('admin.users.index', [
            'users'  => $query->paginate(15)->withQueryString(),
            'search' => $search
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'role'     => 'required',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
{
    $request->validate([
        'name'  => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role'  => 'required',
    ]);

    $update = [
        'name'  => $request->name,
        'email' => $request->email,
        'role'  => $request->role,
    ];

    if ($request->password) {
        $request->validate(['password' => 'min:6']);
        $update['password'] = Hash::make($request->password);
    }

    $user->update($update);

    if (auth()->id() == $user->id) {
        auth()->setUser($user);
    }

    return redirect()->route('admin.users.index')
        ->with('success', 'User berhasil diperbarui.');
}


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
