<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('is-super-admin');

        $search = $request->get('search');
        
        // Construction de la requête de base (exclut les éléments supprimés)
        $query = User::whereIn('role', ['admin','super_admin']);

        // Ajout de la recherche si un terme est fourni
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%");
            });
        }

        $admins = $query->orderBy('role','desc')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admins.index', compact('admins','search'));
    }

    public function create()
    {
        Gate::authorize('is-super-admin');
        return view('admins.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('is-super-admin');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,super_admin',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'], // casting hashed in User model
            'role' => $data['role'],
        ]);

        return redirect()->route('admins.index')->with('success', 'Administrateur créé avec succès');
    }

    public function edit(User $admin)
    {
        Gate::authorize('is-super-admin');
        return view('admins.edit', compact('admin'));
    }

    public function update(Request $request, User $admin)
    {
        Gate::authorize('is-super-admin');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,super_admin',
        ]);

        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
        ];

        // Mettre à jour le mot de passe seulement s'il est fourni
        if (!empty($data['password'])) {
            $updateData['password'] = $data['password'];
        }

        $admin->update($updateData);

        return redirect()->route('admins.index')->with('success', 'Administrateur mis à jour avec succès');
    }

    public function destroy(User $admin)
    {
        Gate::authorize('is-super-admin');

        // Empêcher la suppression de son propre compte
        if ($admin->id === auth()->id()) {
            return redirect()->route('admins.index')->with('error', 'Vous ne pouvez pas supprimer votre propre compte');
        }

        $admin->delete();

        return redirect()->route('admins.index')->with('success', 'Administrateur supprimé avec succès');
    }
}


