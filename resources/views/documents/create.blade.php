<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajouter les documents pour : {{ $personne->prenom }} {{ $personne->nom }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4">Le pop-up s'ouvrira ici. En attendant, nous utilisons cette page pour le téléversement des documents.</p>
                     @if ($errors->any())
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Oups! Il y a eu des erreurs :</strong>
                            <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('documents.store', ['personne' => $personne->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label for="photo" class="block font-medium text-sm text-gray-700">Photo de la personne (obligatoire)</label>
                                <input type="file" name="photo" id="photo" class="block mt-1 w-full" required>
                            </div>

                            <div>
                                <label for="cip" class="block font-medium text-sm text-gray-700">PDF du CIP ou Carte d'identité (obligatoire)</label>
                                <input type="file" name="cip" id="cip" class="block mt-1 w-full" required>
                            </div>

                            <div>
                                <label for="passeport" class="block font-medium text-sm text-gray-700">PDF du Passeport (optionnel)</label>
                                <input type="file" name="passeport" id="passeport" class="block mt-1 w-full">
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Terminer l'enregistrement
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
