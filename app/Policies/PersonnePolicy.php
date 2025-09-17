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
        // Tous les utilisateurs (admin et super_admin) peuvent voir toutes les personnes
        return in_array($user->role, ['admin', 'super_admin']);
    }

    public function export(User $user): bool
    {
        return $user->role === 'super_admin';
    }

    public function update(User $user, Personne $personne): bool
    {
        // Tous les utilisateurs (admin et super_admin) peuvent modifier les personnes
        return in_array($user->role, ['admin', 'super_admin']);
    }

    public function delete(User $user, Personne $personne): bool
    {
        return $user->role === 'super_admin';
    }
}


