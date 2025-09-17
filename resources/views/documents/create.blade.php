@extends('layouts.app-shell')

@section('title','Documents - IdentifiGen')
@section('header','Ajouter les documents pour : ' . $personne->prenom . ' ' . $personne->nom)

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Navigation -->
    <x-page-navigation 
        :backUrl="route('personnes.show', $personne)" 
        backText="Retour aux détails"
        :actions="[
            [
                'url' => route('personnes.show', $personne),
                'text' => 'Voir les détails',
                'icon' => 'eye',
                'class' => 'bg-gray-600 text-white hover:bg-gray-700'
            ]
        ]"
    />
    
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-700 rounded-lg">
            <strong class="font-bold">Oups! Il y a eu des erreurs :</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white overflow-hidden shadow-sm rounded-xl">
        <div class="p-6 md:p-8">
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-2">Finalisation de l'enregistrement</h2>
                <p class="text-sm text-gray-600">Ajoutez les documents nécessaires pour compléter l'enregistrement de <strong>{{ $personne->prenom }} {{ $personne->nom }}</strong></p>
                <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <p class="text-sm text-blue-800">
                        <strong>Étape 2/2 :</strong> Les informations de base ont été enregistrées. Il ne reste plus qu'à ajouter les documents pour finaliser l'enregistrement.
                    </p>
                </div>
            </div>

            <form action="{{ route('documents.store', ['personne' => $personne->id]) }}" method="POST" enctype="multipart/form-data" x-data="{ 
                photoFile: null, 
                cipFile: null, 
                passeportFile: null,
                handleFileChange(event, type) {
                    const file = event.target.files[0];
                    if (file) {
                        this[type + 'File'] = file;
                    }
                }
            }">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">
                            Photo de la personne <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors" 
                             :class="photoFile ? 'border-green-400 bg-green-50' : ''">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12" 
                                     :class="photoFile ? 'text-green-500' : 'text-gray-400'" 
                                     stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm" :class="photoFile ? 'text-green-600' : 'text-gray-600'">
                                    <label for="photo" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span x-text="photoFile ? 'Photo sélectionnée' : 'Télécharger une photo'"></span>
                                        <input id="photo" name="photo" type="file" accept="image/png, image/jpeg" class="sr-only" required 
                                               @change="handleFileChange($event, 'photo')">
                                    </label>
                                    <p class="pl-1" x-show="!photoFile">ou glisser-déposer</p>
                                </div>
                                <p class="text-xs" :class="photoFile ? 'text-green-500' : 'text-gray-500'" 
                                   x-text="photoFile ? photoFile.name : 'PNG, JPG jusqu\'à 2MB'"></p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="cip" class="block text-sm font-medium text-gray-700 mb-2">
                            PDF du CIP ou Carte d'identité <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors" 
                             :class="cipFile ? 'border-green-400 bg-green-50' : ''">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12" 
                                     :class="cipFile ? 'text-green-500' : 'text-gray-400'" 
                                     stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h8m0-18h8a2 2 0 012 2v16a2 2 0 01-2 2h-8m0-18v18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm" :class="cipFile ? 'text-green-600' : 'text-gray-600'">
                                    <label for="cip" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span x-text="cipFile ? 'CIP sélectionné' : 'Télécharger le CIP'"></span>
                                        <input id="cip" name="cip" type="file" accept=".pdf" class="sr-only" required 
                                               @change="handleFileChange($event, 'cip')">
                                    </label>
                                    <p class="pl-1" x-show="!cipFile">ou glisser-déposer</p>
                                </div>
                                <p class="text-xs" :class="cipFile ? 'text-green-500' : 'text-gray-500'" 
                                   x-text="cipFile ? cipFile.name : 'PDF jusqu\'à 2MB'"></p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="passeport" class="block text-sm font-medium text-gray-700 mb-2">
                            PDF du Passeport (optionnel)
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors" 
                             :class="passeportFile ? 'border-green-400 bg-green-50' : ''">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12" 
                                     :class="passeportFile ? 'text-green-500' : 'text-gray-400'" 
                                     stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h8m0-18h8a2 2 0 012 2v16a2 2 0 01-2 2h-8m0-18v18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm" :class="passeportFile ? 'text-green-600' : 'text-gray-600'">
                                    <label for="passeport" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span x-text="passeportFile ? 'Passeport sélectionné' : 'Télécharger le passeport'"></span>
                                        <input id="passeport" name="passeport" type="file" accept=".pdf" class="sr-only" 
                                               @change="handleFileChange($event, 'passeport')">
                                    </label>
                                    <p class="pl-1" x-show="!passeportFile">ou glisser-déposer</p>
                                </div>
                                <p class="text-xs" :class="passeportFile ? 'text-green-500' : 'text-gray-500'" 
                                   x-text="passeportFile ? passeportFile.name : 'PDF jusqu\'à 2MB (optionnel)'"></p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('personnes.index') }}" 
                           class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                            Annuler
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Terminer l'enregistrement
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
