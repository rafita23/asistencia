<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
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
    try {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'rol' => 'required|in:administrador,trabajador',
            'fotografia' => 'nullable|image|max:2048',
            'cargo' => 'nullable|string|max:255',
            'celular' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
        ]);
        

        if ($request->hasFile('fotografia')) {
            $data['fotografia'] = $request->file('fotografia')->store('usuarios', 'public');
        }

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    } catch (\Exception $e) {
        \Log::error("Error al crear usuario: {$e->getMessage()}");
        return back()->withErrors('Ocurrió un error al intentar crear el usuario.')->withInput();
    }
}

    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8',
        'rol' => 'required|in:administrador,trabajador',
        'fotografia' => 'nullable|image|max:2048',
        'cargo' => 'nullable|string|max:255',
        'celular' => 'nullable|string|max:15',
        'direccion' => 'nullable|string|max:255',
    ]);

    if ($request->hasFile('fotografia')) {
        if ($user->fotografia) {
            Storage::delete($user->fotografia);
        }
        $data['fotografia'] = $request->file('fotografia')->store('usuarios', 'public');
    }

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
{
    if ($user->fotografia) {
        Storage::delete($user->fotografia);
    }

    $user->delete();
    return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
}

}
