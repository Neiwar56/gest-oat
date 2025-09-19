@extends('layouts.app-shell')

@section('title','Créer un administrateur - IdentifiGen')
@section('header','Créer un administrateur')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Navigation -->
    <x-page-navigation
        :backUrl="route('admins.index')"
        backText="Retour à la liste"
        :actions="[
            [
                'url' => route('admins.index'),
                'text' => 'Voir tous les administrateurs',
                'icon' => 'list',
                'class' => 'bg-gray-600 text-white hover:bg-gray-700'
            ]
        ]"
    />

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">{{ session('success') }}</div>
    @endif

    <div class="bg-white overflow-hidden shadow-sm rounded-xl">
        <div class="p-6 md:p-8">
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-2">Informations de l'administrateur</h2>
                <p class="text-sm text-gray-600">Remplissez les informations pour créer un nouveau compte administrateur</p>
            </div>

            <form method="POST" action="{{ route('admins.store') }}" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               placeholder="Entrez le nom complet" required>
                        @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Adresse email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               placeholder="exemple@email.com" required>
                        @error('email')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                        <input type="password" name="password"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               placeholder="Mot de passe sécurisé" required>
                        @error('password')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               placeholder="Confirmez le mot de passe" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rôle de l'administrateur</label>
                    <select name="role"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                            required>
                        <option value="">-- Sélectionner un rôle --</option>
                        <option value="admin" {{ old('role')==='admin' ? 'selected' : '' }}>Admin (Sous-Admin)</option>
                        <option value="super_admin" {{ old('role')==='super_admin' ? 'selected' : '' }}>Super Admin</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Le Super Admin a tous les droits, l'Admin peut seulement créer et lister des personnes</p>
                </div>

                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admins.index') }}"
                       class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Annuler
                    </a>
                    <button type="submit"
                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors font-medium">
                        Créer l'administrateur
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


