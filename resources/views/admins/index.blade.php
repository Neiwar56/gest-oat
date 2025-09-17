@extends('layouts.app-shell')

@section('title','Administrateurs - IdentifiGen')
@section('header','Administrateurs')

@section('content')
<div class="bg-white rounded-xl shadow overflow-hidden" data-aos="fade-up">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold">Liste des Administrateurs</h2>
            <a href="{{ route('admins.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <i data-feather="user-plus" class="w-4 h-4 mr-2"></i> Nouvel Admin
            </a>
        </div>
        
        <!-- Barre de recherche -->
        <form method="GET" action="{{ route('admins.index') }}" class="flex items-center space-x-4">
            <div class="flex-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i data-feather="search" class="h-4 w-4 text-gray-400"></i>
                </div>
                <input type="text" 
                       name="search" 
                       value="{{ $search ?? '' }}"
                       placeholder="Rechercher par nom, email ou rôle..."
                       class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <button type="submit" 
                    class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                <i data-feather="search" class="w-4 h-4 mr-2"></i>
                Rechercher
            </button>
            @if($search ?? false)
                <a href="{{ route('admins.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    <i data-feather="x" class="w-4 h-4 mr-2"></i>
                    Effacer
                </a>
            @endif
        </form>
    </div>
    
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-700 rounded-lg">{{ session('error') }}</div>
    @endif
    
    @if($search ?? false)
        <div class="px-6 py-3 bg-blue-50 border-b border-blue-200">
            <p class="text-sm text-blue-700">
                <i data-feather="info" class="w-4 h-4 inline mr-1"></i>
                Résultats de recherche pour "<strong>{{ $search }}</strong>" : {{ $admins->count() }} résultat(s) trouvé(s)
            </p>
        </div>
    @endif
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($admins as $admin)
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $admin->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $admin->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $admin->role === 'super_admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ ucfirst(str_replace('_', ' ', $admin->role)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <button onclick="showAdminDetails({{ $admin->id }}, '{{ $admin->name }}', '{{ $admin->email }}', '{{ $admin->role }}', '{{ $admin->created_at->format('d/m/Y à H:i') }}')"
                                        class="inline-flex items-center px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition-colors">
                                    <i data-feather="eye" class="w-3 h-3 mr-1"></i>
                                    Voir
                                </button>
                                <a href="{{ route('admins.edit', $admin) }}" 
                                   class="inline-flex items-center px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 transition-colors">
                                    <i data-feather="edit" class="w-3 h-3 mr-1"></i>
                                    Modifier
                                </a>
                                <form action="{{ route('admins.destroy', $admin) }}" method="POST" class="inline" 
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet administrateur ? Cette action est irréversible.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center px-2 py-1 text-xs bg-red-100 text-red-700 rounded hover:bg-red-200 transition-colors">
                                        <i data-feather="trash-2" class="w-3 h-3 mr-1"></i>
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td class="px-6 py-4" colspan="4">Aucun administrateur.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="px-6 py-4 border-t border-gray-200">
        <x-pagination :paginator="$admins" />
    </div>
</div>

<!-- Modal pour afficher les détails de l'administrateur -->
<div id="adminModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Détails de l'administrateur</h3>
                <button onclick="closeAdminModal()" class="text-gray-400 hover:text-gray-600">
                    <i data-feather="x" class="w-5 h-5"></i>
                </button>
            </div>
            <div class="space-y-3">
                <div>
                    <label class="text-sm font-medium text-gray-500">Nom complet</label>
                    <p id="modalName" class="text-gray-900"></p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Email</label>
                    <p id="modalEmail" class="text-gray-900"></p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Rôle</label>
                    <p id="modalRole" class="text-gray-900"></p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Créé le</label>
                    <p id="modalCreated" class="text-gray-900"></p>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button onclick="closeAdminModal()" 
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function showAdminDetails(id, name, email, role, created) {
    document.getElementById('modalName').textContent = name;
    document.getElementById('modalEmail').textContent = email;
    document.getElementById('modalRole').textContent = role === 'super_admin' ? 'Super Admin' : 'Admin';
    document.getElementById('modalCreated').textContent = created;
    document.getElementById('adminModal').classList.remove('hidden');
}

function closeAdminModal() {
    document.getElementById('adminModal').classList.add('hidden');
}

// Fermer la modal en cliquant à l'extérieur
document.getElementById('adminModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAdminModal();
    }
});
</script>
@endsection


