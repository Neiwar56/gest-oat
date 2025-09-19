@extends('layouts.app-shell')

@section('title','Personnes - IdentifiGen')

@section('content')
<div class="bg-white rounded-xl shadow overflow-hidden" data-aos="fade-up">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold">Liste des Personnes</h2>
            <a href="{{ route('personnes.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <i data-feather="user-plus" class="w-4 h-4 mr-2"></i> Ajouter
            </a>
        </div>

        <!-- Barre de recherche -->
        <form method="GET" action="{{ route('personnes.index') }}" class="flex items-center space-x-4">
            <div class="flex-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i data-feather="search" class="h-4 w-4 text-gray-400"></i>
                </div>
                <input type="text"
                       name="search"
                       value="{{ $search ?? '' }}"
                       placeholder="Rechercher par nom, prénom, email, téléphone, CIP, église ou créateur..."
                       class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                <i data-feather="search" class="w-4 h-4 mr-2"></i>
                Rechercher
            </button>
            @if($search ?? false)
                <a href="{{ route('personnes.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    <i data-feather="x" class="w-4 h-4 mr-2"></i>
                    Effacer
                </a>
            @endif
        </form>
    </div>
    @if($search ?? false)
        <div class="px-6 py-3 bg-blue-50 border-b border-blue-200">
            <p class="text-sm text-blue-700">
                <i data-feather="info" class="w-4 h-4 inline mr-1"></i>
                Résultats de recherche pour "<strong>{{ $search }}</strong>" : {{ $personnes->total() }} résultat(s) trouvé(s)
            </p>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom Complet</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Église</th>
                    @can('is-super-admin')
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Créé par</th>
                    @endcan
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($personnes as $personne)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $personne->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="h-10 w-10">
                                @if($personne->photo_path)
                                    <img src="{{ asset('storage/'.$personne->photo_path) }}" alt="" class="h-10 w-10 rounded-full object-cover"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                    <div class="h-10 w-10 rounded-full bg-red-200 flex items-center justify-center text-xs" style="display: none;" title="{{ $personne->photo_path }}">
                                        ❌
                                    </div>
                                @else
                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-xs">
                                        📷
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $personne->nom }} {{ $personne->prenom }}</div>
                            <div class="text-sm text-gray-500">{{ $personne->email ?? '' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $personne->eglise->nom ?? 'N/A' }}</td>
                        @can('is-super-admin')
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $personne->adminCreateur->name ?? 'N/A' }}</td>
                        @endcan
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $personne->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('personnes.show', $personne) }}"
                                   class="inline-flex items-center px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition-colors">
                                    <i data-feather="eye" class="w-3 h-3 mr-1"></i>
                                    Voir
                                </a>
                                <a href="{{ route('personnes.edit', $personne) }}"
                                   class="inline-flex items-center px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 transition-colors">
                                    <i data-feather="edit" class="w-3 h-3 mr-1"></i>
                                    Modifier
                                </a>
                                @can('is-super-admin')
                                    <form action="{{ route('personnes.destroy', $personne) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette personne ? Cette action est irréversible.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-2 py-1 text-xs bg-red-100 text-red-700 rounded hover:bg-red-200 transition-colors">
                                            <i data-feather="trash-2" class="w-3 h-3 mr-1"></i>
                                            Supprimer
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role === 'super_admin' ? '7' : '6' }}" class="text-center py-4">Aucune personne enregistrée pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-200">
        <x-pagination :paginator="$personnes" />
    </div>
    </div>
@endsection
