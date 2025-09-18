<?php

namespace App\Policies;

use App\Models\Personne;
use App\Models\User;

class PersonnePolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'super_admin']);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'super_admin']);
    }

    public function view(User $user, Personne $personne): bool
    {
        // Le super admin peut voir toutes les personnes
        if ($user->role === 'super_admin') {
            return true;
        }
        
        // Les admins normaux ne peuvent voir que leurs propres personnes
        if ($user->role === 'admin') {
            return $personne->admin_createur_id === $user->id;
        }
        
        return false;
    }

    public function export(User $user): bool
    {
        return $user->role === 'super_admin';
    }

    public function update(User $user, Personne $personne): bool
    {
        // Le super admin peut modifier toutes les personnes
        if ($user->role === 'super_admin') {
            return true;
        }
        
        // Les admins normaux ne peuvent modifier que leurs propres personnes
        if ($user->role === 'admin') {
            return $personne->admin_createur_id === $user->id;
        }
        
        return false;
    }

    public function delete(User $user, Personne $personne): bool
    {
        return $user->role === 'super_admin';
    }
}


