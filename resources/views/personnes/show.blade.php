@extends('layouts.app-shell')

@section('title','Détails personne - IdentifiGen')
@section('header','Détails de la personne')

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- En-tête avec photo et infos principales -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-8">
                <div class="flex items-center space-x-6">
                    <div class="w-32 h-32 rounded-full overflow-hidden bg-white shadow-lg">
                        @if($personne->photo_path)
                            <img src="{{ asset('storage/'.$personne->photo_path) }}" alt="photo" class="w-full h-full object-cover" 
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <div class="w-full h-full flex items-center justify-center text-gray-500 text-sm" style="display: none;">
                                <i data-feather="user" class="w-8 h-8"></i>
                            </div>
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-500">
                                <i data-feather="user" class="w-12 h-12"></i>
                            </div>
                        @endif
                    </div>
                    <div class="text-white">
                        <h1 class="text-3xl font-bold mb-2">{{ $personne->prenom }} {{ $personne->nom }}</h1>
                        <p class="text-blue-100 text-lg mb-1">{{ $personne->eglise->nom ?? 'N/A' }}</p>
                        @can('is-super-admin')
                            <p class="text-blue-100 text-sm">Créé par: {{ $personne->adminCreateur->name ?? 'N/A' }}</p>
                        @endcan
                        <div class="flex items-center space-x-4 mt-4">
                            <div class="flex items-center space-x-2">
                                <i data-feather="phone" class="w-4 h-4"></i>
                                <span>{{ $personne->telephone }}</span>
                            </div>
                            @if($personne->email)
                                <div class="flex items-center space-x-2">
                                    <i data-feather="mail" class="w-4 h-4"></i>
                                    <span>{{ $personne->email }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informations détaillées -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Informations personnelles -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i data-feather="user" class="w-5 h-5 mr-2"></i>
                        Informations personnelles
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Date de naissance</label>
                            <p class="text-gray-900">{{ optional($personne->date_naissance)->format('d/m/Y') ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Lieu de naissance</label>
                            <p class="text-gray-900">{{ $personne->lieu_naissance ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Sexe</label>
                            <p class="text-gray-900">{{ $personne->sexe ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Situation matrimoniale</label>
                            <p class="text-gray-900">{{ $personne->situation_matrimoniale ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Profession</label>
                        <p class="text-gray-900">{{ $personne->profession ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Nationalité</label>
                        <p class="text-gray-900">{{ $personne->nationalite ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Informations de contact -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i data-feather="map-pin" class="w-5 h-5 mr-2"></i>
                        Informations de contact
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Adresse</label>
                        <p class="text-gray-900">{{ $personne->adresse_exacte ?? 'N/A' }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Téléphone</label>
                            <p class="text-gray-900">{{ $personne->telephone ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Email</label>
                            <p class="text-gray-900">{{ $personne->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents d'identité -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i data-feather="credit-card" class="w-5 h-5 mr-2"></i>
                        Documents d'identité
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">N° CIP/NPI</label>
                            <p class="text-gray-900">{{ $personne->numero_cip ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Lieu de délivrance</label>
                            <p class="text-gray-900">{{ $personne->lieu_delivrance_cip ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Date de délivrance</label>
                            <p class="text-gray-900">{{ optional($personne->date_delivrance_cip)->format('d/m/Y') ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Date d'expiration</label>
                            <p class="text-gray-900">{{ optional($personne->date_expiration_cip)->format('d/m/Y') ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filiation -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i data-feather="users" class="w-5 h-5 mr-2"></i>
                        Filiation
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Père</label>
                            <p class="text-gray-900">{{ $personne->prenom_pere ?? 'N/A' }} {{ $personne->nom_pere ?? '' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Mère</label>
                            <p class="text-gray-900">{{ $personne->prenom_mere ?? 'N/A' }} {{ $personne->nom_mere ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents uploadés -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden lg:col-span-2">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i data-feather="file-text" class="w-5 h-5 mr-2"></i>
                        Documents uploadés
                        @if($personne->documents && $personne->documents->count() > 0)
                            <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                {{ $personne->documents->count() }} document(s)
                            </span>
                        @endif
                    </h3>
                </div>
                <div class="p-6">
                    @if($personne->documents && $personne->documents->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($personne->documents as $document)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-all duration-200 hover:border-gray-300">
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            @if($document->type_document === 'photo')
                                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                                    <i data-feather="image" class="w-6 h-6 text-blue-600"></i>
                                                </div>
                                            @elseif($document->type_document === 'cip')
                                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                                    <i data-feather="credit-card" class="w-6 h-6 text-green-600"></i>
                                                </div>
                                            @elseif($document->type_document === 'passeport')
                                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                                    <i data-feather="book-open" class="w-6 h-6 text-purple-600"></i>
                                                </div>
                                            @else
                                                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                                    <i data-feather="file" class="w-6 h-6 text-gray-600"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 capitalize">
                                                {{ str_replace('_', ' ', $document->type_document) }}
                                            </p>
                                            <p class="text-xs text-gray-500 truncate" title="{{ basename($document->chemin_fichier) }}">
                                                {{ basename($document->chemin_fichier) }}
                                            </p>
                                            <p class="text-xs text-gray-400 mt-1">
                                                Ajouté le {{ $document->created_at->format('d/m/Y à H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-3 flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ asset('storage/'.$document->chemin_fichier) }}" 
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="inline-flex items-center px-3 py-1 border border-gray-300 text-gray-700 text-xs rounded-md hover:bg-gray-50 transition-colors">
                                                <i data-feather="eye" class="w-3 h-3 mr-1"></i>
                                                Voir
                                            </a>
                                            <a href="{{ asset('storage/'.$document->chemin_fichier) }}" 
                                               download="{{ basename($document->chemin_fichier) }}"
                                               class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-xs rounded-md hover:bg-blue-700 transition-colors">
                                                <i data-feather="download" class="w-3 h-3 mr-1"></i>
                                                Télécharger
                                            </a>
                                        </div>
                                        @if($document->type_document === 'photo')
                                            <div class="w-8 h-8 rounded-lg overflow-hidden">
                                                <img src="{{ asset('storage/'.$document->chemin_fichier) }}" 
                                                     alt="Aperçu" 
                                                     class="w-full h-full object-cover"
                                                     onerror="this.style.display='none'">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i data-feather="file-x" class="w-8 h-8 text-gray-400"></i>
                            </div>
                            <h4 class="text-lg font-medium text-gray-900 mb-2">Aucun document uploadé</h4>
                            <p class="text-gray-500 text-sm">Cette personne n'a pas encore de documents associés.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Actions -->
        <x-page-navigation 
            :backUrl="route('personnes.index')" 
            backText="Retour à la liste"
            :actions="[
                [
                    'url' => route('personnes.edit', $personne),
                    'text' => 'Modifier',
                    'icon' => 'edit',
                    'class' => 'bg-blue-600 text-white hover:bg-blue-700'
                ]
            ]"
        />
    </div>
@endsection


