<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des Personnes Enregistrées') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm">ID</th>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm">Nom Complet</th>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm">Église</th>
                                    @can('is-super-admin')
                                        <th class="py-3 px-4 uppercase font-semibold text-sm">Créé par</th>
                                    @endcan
                                    <th class="py-3 px-4 uppercase font-semibold text-sm">Date</th>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @forelse ($personnes as $personne)
                                    <tr class="border-b">
                                        <td class="py-3 px-4">{{ $personne->id }}</td>
                                        <td class="py-3 px-4">{{ $personne->nom }} {{ $personne->prenom }}</td>
                                        <td class="py-3 px-4">{{ $personne->eglise->nom ?? 'N/A' }}</td>
                                        @can('is-super-admin')
                                            <td class="py-3 px-4">{{ $personne->adminCreateur->name ?? 'N/A' }}</td>
                                        @endcan
                                        <td class="py-3 px-4">{{ $personne->created_at->format('d/m/Y') }}</td>
                                        <td class="py-3 px-4">
                                            <a href="#" class="text-blue-500 hover:text-blue-700">Voir</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">Aucune personne enregistrée pour le moment.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $personnes->links() }} </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
