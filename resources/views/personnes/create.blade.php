<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Enregistrer une nouvelle personne') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900" x-data="{ step: 1 }">

                    <div class="flex justify-between mb-8">
                        <div class="text-center">
                            <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center text-lg" :class="step === 1 ? 'bg-blue-600 text-white' : 'bg-gray-200'">1</div>
                            <p class="text-xs mt-1">Localisation</p>
                        </div>
                        <div class="text-center">
                            <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center text-lg" :class="step === 2 ? 'bg-blue-600 text-white' : 'bg-gray-200'">2</div>
                            <p class="text-xs mt-1">Identité</p>
                        </div>
                        <div class="text-center">
                            <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center text-lg" :class="step === 3 ? 'bg-blue-600 text-white' : 'bg-gray-200'">3</div>
                            <p class="text-xs mt-1">Filiation</p>
                        </div>
                        <div class="text-center">
                            <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center text-lg" :class="step === 4 ? 'bg-blue-600 text-white' : 'bg-gray-200'">4</div>
                            <p class="text-xs mt-1">Contact</p>
                        </div>
                    </div>

                    <form action="{{ route('personnes.store') }}" method="POST">
                        @csrf

                        <div x-show="step === 1">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Étape 1: Localisation</h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="localite_id" class="block font-medium text-sm text-gray-700">Localité</label>
                                    <select name="localite_id" id="localite_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                                        <option value="">-- Choisir une localité --</option>
                                        @foreach ($localites as $localite)
                                            <option value="{{ $localite->id }}">{{ $localite->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="eglise_id" class="block font-medium text-sm text-gray-700">Église</label>
                                    <select name="eglise_id" id="eglise_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                                        <option value="">-- Choisir une église --</option>
                                        @foreach ($eglises as $eglise)
                                            <option value="{{ $eglise->id }}">{{ $eglise->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div x-show="step === 2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Étape 2: Identité</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div><label for="nom" class="block font-medium text-sm text-gray-700">Nom</label><input type="text" name="nom" id="nom" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"></div>
                                <div><label for="prenom" class="block font-medium text-sm text-gray-700">Prénom</label><input type="text" name="prenom" id="prenom" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"></div>
                                <div><label for="date_naissance" class="block font-medium text-sm text-gray-700">Date de naissance</label><input type="date" name="date_naissance" id="date_naissance" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"></div>
                                <div><label for="lieu_naissance" class="block font-medium text-sm text-gray-700">Lieu de naissance</label><input type="text" name="lieu_naissance" id="lieu_naissance" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"></div>
                                <div><label for="sexe" class="block font-medium text-sm text-gray-700">Sexe</label><select name="sexe" id="sexe" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"><option value="Masculin">Masculin</option><option value="Féminin">Féminin</option></select></div>
                                <div><label for="situation_matrimoniale" class="block font-medium text-sm text-gray-700">Situation Matrimoniale</label><select name="situation_matrimoniale" id="situation_matrimoniale" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"><option value="Célibataire">Célibataire</option><option value="Marié(e)">Marié(e)</option><option value="Divorcé(e)">Divorcé(e)</option><option value="Veuf(ve)">Veuf(ve)</option></select></div>
                                <div><label for="profession" class="block font-medium text-sm text-gray-700">Profession</label><input type="text" name="profession" id="profession" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"></div>
                                <div class="md:col-span-2"><label for="adresse_exacte" class="block font-medium text-sm text-gray-700">Adresse Exacte</label><textarea name="adresse_exacte" id="adresse_exacte" rows="3" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"></textarea></div>
                                <div><label for="numero_cip" class="block font-medium text-sm text-gray-700">N° CIP / NPI</label><input type="text" name="numero_cip" id="numero_cip" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"></div>
                                <div><label for="lieu_delivrance_cip" class="block font-medium text-sm text-gray-700">Lieu de délivrance</label><input type="text" name="lieu_delivrance_cip" id="lieu_delivrance_cip" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"></div>
                                <div><label for="date_delivrance_cip" class="block font-medium text-sm text-gray-700">Date de délivrance</label><input type="date" name="date_delivrance_cip" id="date_delivrance_cip" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"></div>
                                <div><label for="date_expiration_cip" class="block font-medium text-sm text-gray-700">Date d'expiration</label><input type="date" name="date_expiration_cip" id="date_expiration_cip" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"></div>
                            </div>
                        </div>

                        <div x-show="step === 3">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Étape 3: Filiation</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div><label for="prenom_pere" class="block font-medium text-sm text-gray-700">Prénom du père</label><input type="text" name="prenom_pere" id="prenom_pere" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"></div>
                                <div><label for="nom_pere" class="block font-medium text-sm text-gray-700">Nom du père</label><input type="text" name="nom_pere" id="nom_pere" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"></div>
                                <div><label for="prenom_mere" class="block font-medium text-sm text-gray-700">Prénom de la mère</label><input type="text" name="prenom_mere" id="prenom_mere" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"></div>
                                <div><label for="nom_mere" class="block font-medium text-sm text-gray-700">Nom de la mère</label><input type="text" name="nom_mere" id="nom_mere" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"></div>
                            </div>
                        </div>

                        <div x-show="step === 4">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Étape 4: Contact</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div><label for="nationalite" class="block font-medium text-sm text-gray-700">Nationalité</label><input type="text" name="nationalite" id="nationalite" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"></div>
                                <div><label for="telephone" class="block font-medium text-sm text-gray-700">N° de Téléphone (obligatoire)</label><input type="tel" name="telephone" id="telephone" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"></div>
                                <div class="md:col-span-2"><label for="email" class="block font-medium text-sm text-gray-700">Email (facultatif)</label><input type="email" name="email" id="email" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"></div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-8">
                            <button type="button" x-show="step > 1" @click.prevent="step--" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Précédent
                            </button>

                            <div x-show="step === 1"></div>

                            <button type="button" x-show="step < 4" @click.prevent="step++" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    Étape suivante
</button>

                            <button type="submit" x-show="step === 4" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Valider et passer aux documents
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
