@extends('layouts.app-shell')

@section('title','Tableau de Bord - IdentifiGen')
@section('header','Tableau de Bord')

@section('content')
    <!-- Cartes de statistiques visibles uniquement pour le Super Admin -->
    @if(Auth::check() && Auth::user()->role === 'super_admin')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Personnes enregistrées -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center justify-between hover:shadow-lg transition">
            <div>
                <p class="text-sm text-gray-500">Personnes enregistrées</p>
                <p class="text-4xl font-bold text-gray-800 mt-2">{{ $totalPersonnes }}</p>
                <p class="text-sm {{ $variationPersonnes >= 0 ? 'text-green-600' : 'text-red-600' }} mt-1">
                    {{ $variationPersonnes >= 0 ? '+' : '' }}{{ $variationPersonnes }}% depuis le mois dernier
                </p>
            </div>
            <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                <i data-feather="users" class="w-6 h-6"></i>
            </div>
        </div>

        <!-- Administrateurs -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center justify-between hover:shadow-lg transition">
            <div>
                <p class="text-sm text-gray-500">Administrateurs</p>
                <p class="text-4xl font-bold text-gray-800 mt-2">{{ $totalAdmins }}</p>
                <p class="text-sm text-gray-400 mt-1">Comptes actifs</p>
            </div>
            <div class="bg-green-100 text-green-600 p-3 rounded-full">
                <i data-feather="shield" class="w-6 h-6"></i>
            </div>
        </div>

        <!-- Activité du jour -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center justify-between hover:shadow-lg transition">
            <div>
                <p class="text-sm text-gray-500">Activité aujourd'hui</p>
                <p class="text-4xl font-bold text-gray-800 mt-2">{{ $activiteDuJour }}</p>
                <p class="text-sm text-gray-400 mt-1">Interactions enregistrées</p>
            </div>
            <div class="bg-purple-100 text-purple-600 p-3 rounded-full">
                <i data-feather="activity" class="w-6 h-6"></i>
            </div>
        </div>
    </div>
    @endif

    <!-- Section principale -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Bloc bienvenue -->
        <div class="lg:col-span-2">
            <div class="bg-gradient-to-r from-blue-500 to-blue-700 p-8 rounded-2xl shadow-lg text-white">
                <h2 class="text-2xl font-bold mb-3">Bienvenue 👋</h2>
                <p class="text-blue-100">Utilisez le menu de gauche ou les actions rapides pour gérer les personnes et administrateurs.
                Suivez les statistiques en temps réel directement depuis ce tableau de bord.</p>
            </div>
        </div>

        <!-- Actions rapides -->
        <div>
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">⚡ Actions rapides</h2>
                <div class="space-y-3">
                    <a href="{{ route('personnes.create') }}"
                       class="flex items-center p-3 bg-blue-50 text-blue-700 rounded-xl hover:bg-blue-100 transition">
                        <i data-feather="user-plus" class="w-5 h-5"></i>
                        <span class="ml-3 font-medium">Ajouter une personne</span>
                    </a>
                    <a href="{{ route('personnes.index') }}"
                       class="flex items-center p-3 bg-gray-50 text-gray-700 rounded-xl hover:bg-gray-100 transition">
                        <i data-feather="users" class="w-5 h-5"></i>
                        <span class="ml-3 font-medium">Voir les personnes</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>feather.replace();</script>
@endsection
