@extends('layouts.app-shell')

@section('title','Tableau de Bord - IdentifiGen')
@section('header','Tableau de Bord')

@section('content')
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2">
        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-xl font-bold mb-4">Bienvenue</h2>
            <p class="text-gray-600">Utilisez le menu pour gérer les personnes.</p>
                        </div>
                    </div>
                    <div>
        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-xl font-bold mb-6">Actions rapides</h2>
                            <div class="space-y-4">
                <a href="{{ route('personnes.create') }}" class="flex items-center p-3 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition">
                                    <i data-feather="user-plus" class="w-5 h-5"></i>
                                    <span class="ml-3 font-medium">Ajouter une personne</span>
                                </a>
                <a href="{{ route('personnes.index') }}" class="flex items-center p-3 bg-gray-50 text-gray-700 rounded-lg hover:bg-gray-100 transition">
                    <i data-feather="users" class="w-5 h-5"></i>
                    <span class="ml-3 font-medium">Voir les personnes</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
