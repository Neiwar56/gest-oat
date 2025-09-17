@extends('layouts.app-shell')

@section('title','Modifier personne - IdentifiGen')
@section('header','Modifier : ' . $personne->prenom . ' ' . $personne->nom)

@section('content')
    <div class="max-w-5xl mx-auto">
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
        
        <div class="bg-white overflow-hidden shadow-sm rounded-xl">
            <div class="p-6 md:p-8 text-gray-900" x-data="{ 
                step: 1,
                validateStep(stepNumber) {
                    if (stepNumber === 1) {
                        return document.getElementById('localite_id').value && document.getElementById('eglise_id').value;
                    }
                    if (stepNumber === 2) {
                        return document.getElementById('nom').value && 
                               document.getElementById('prenom').value && 
                               document.getElementById('date_naissance').value && 
                               document.getElementById('lieu_naissance').value && 
                               document.getElementById('sexe').value && 
                               document.getElementById('situation_matrimoniale').value;
                    }
                    if (stepNumber === 3) {
                        return true; // La filiation est optionnelle
                    }
                    if (stepNumber === 4) {
                        return document.getElementById('telephone').value;
                    }
                    return false;
                },
                nextStep() {
                    if (this.validateStep(this.step)) {
                        this.step++;
                    } else {
                        alert('Veuillez remplir tous les champs obligatoires de cette étape.');
                    }
                },
                prevStep() {
                    if (this.step > 1) {
                        this.step--;
                    }
                }
            }">
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-2">Modification des informations</h2>
                    <p class="text-sm text-gray-600">Modifiez les informations de {{ $personne->prenom }} {{ $personne->nom }} en suivant les étapes ci-dessous</p>
                </div>

                <div class="flex justify-between mb-8 relative">
                    <div class="absolute top-4 left-0 right-0 h-0.5 bg-gray-200 -z-10"></div>
                    <div class="text-center relative z-10">
                        <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center text-sm font-semibold transition-colors" 
                             :class="step === 1 ? 'bg-blue-600 text-white ring-4 ring-blue-200' : (step > 1 ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-500')">1</div>
                        <p class="text-xs mt-2 font-medium" :class="step === 1 ? 'text-blue-600' : (step > 1 ? 'text-green-600' : 'text-gray-500')">Localisation</p>
                    </div>
                    <div class="text-center relative z-10">
                        <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center text-sm font-semibold transition-colors" 
                             :class="step === 2 ? 'bg-blue-600 text-white ring-4 ring-blue-200' : (step > 2 ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-500')">2</div>
                        <p class="text-xs mt-2 font-medium" :class="step === 2 ? 'text-blue-600' : (step > 2 ? 'text-green-600' : 'text-gray-500')">Identité</p>
                    </div>
                    <div class="text-center relative z-10">
                        <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center text-sm font-semibold transition-colors" 
                             :class="step === 3 ? 'bg-blue-600 text-white ring-4 ring-blue-200' : (step > 3 ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-500')">3</div>
                        <p class="text-xs mt-2 font-medium" :class="step === 3 ? 'text-blue-600' : (step > 3 ? 'text-green-600' : 'text-gray-500')">Filiation</p>
                    </div>
                    <div class="text-center relative z-10">
                        <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center text-sm font-semibold transition-colors" 
                             :class="step === 4 ? 'bg-blue-600 text-white ring-4 ring-blue-200' : 'bg-gray-200 text-gray-500'">4</div>
                        <p class="text-xs mt-2 font-medium" :class="step === 4 ? 'text-blue-600' : 'text-gray-500'">Contact</p>
                    </div>
                </div>

                <form action="{{ route('personnes.update', $personne) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div x-show="step === 1" class="space-y-6">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-blue-900 mb-2">Étape 1: Localisation</h3>
                            <p class="text-sm text-blue-700">Sélectionnez la localité et l'église de la personne</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="localite_id" class="block text-sm font-medium text-gray-700 mb-2">Localité</label>
                                <select name="localite_id" id="localite_id" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    <option value="">-- Choisir une localité --</option>
                                    @foreach ($localites as $localite)
                                        <option value="{{ $localite->id }}" {{ $personne->localite_id == $localite->id ? 'selected' : '' }}>{{ $localite->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="eglise_id" class="block text-sm font-medium text-gray-700 mb-2">Église</label>
                                <select name="eglise_id" id="eglise_id" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    <option value="">-- Choisir une église --</option>
                                    @foreach ($eglises as $eglise)
                                        <option value="{{ $eglise->id }}" {{ $personne->eglise_id == $eglise->id ? 'selected' : '' }}>{{ $eglise->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div x-show="step === 2" class="space-y-6">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-blue-900 mb-2">Étape 2: Identité</h3>
                            <p class="text-sm text-blue-700">Informations personnelles et documents d'identité</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                                <input type="text" name="nom" id="nom" value="{{ old('nom', $personne->nom) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                       placeholder="Nom de famille">
                            </div>
                            <div>
                                <label for="prenom" class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                                <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $personne->prenom) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                       placeholder="Prénom">
                            </div>
                            <div>
                                <label for="date_naissance" class="block text-sm font-medium text-gray-700 mb-2">Date de naissance</label>
                                <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance', $personne->date_naissance) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>
                            <div>
                                <label for="lieu_naissance" class="block text-sm font-medium text-gray-700 mb-2">Lieu de naissance</label>
                                <input type="text" name="lieu_naissance" id="lieu_naissance" value="{{ old('lieu_naissance', $personne->lieu_naissance) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                       placeholder="Ville de naissance">
                            </div>
                            <div>
                                <label for="sexe" class="block text-sm font-medium text-gray-700 mb-2">Sexe</label>
                                <select name="sexe" id="sexe" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    <option value="">-- Sélectionner --</option>
                                    <option value="Masculin" {{ old('sexe', $personne->sexe) == 'Masculin' ? 'selected' : '' }}>Masculin</option>
                                    <option value="Féminin" {{ old('sexe', $personne->sexe) == 'Féminin' ? 'selected' : '' }}>Féminin</option>
                                </select>
                            </div>
                            <div>
                                <label for="situation_matrimoniale" class="block text-sm font-medium text-gray-700 mb-2">Situation Matrimoniale</label>
                                <select name="situation_matrimoniale" id="situation_matrimoniale" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    <option value="">-- Sélectionner --</option>
                                    <option value="Célibataire" {{ old('situation_matrimoniale', $personne->situation_matrimoniale) == 'Célibataire' ? 'selected' : '' }}>Célibataire</option>
                                    <option value="Marié(e)" {{ old('situation_matrimoniale', $personne->situation_matrimoniale) == 'Marié(e)' ? 'selected' : '' }}>Marié(e)</option>
                                    <option value="Divorcé(e)" {{ old('situation_matrimoniale', $personne->situation_matrimoniale) == 'Divorcé(e)' ? 'selected' : '' }}>Divorcé(e)</option>
                                    <option value="Veuf(ve)" {{ old('situation_matrimoniale', $personne->situation_matrimoniale) == 'Veuf(ve)' ? 'selected' : '' }}>Veuf(ve)</option>
                                </select>
                            </div>
                            <div>
                                <label for="profession" class="block text-sm font-medium text-gray-700 mb-2">Profession</label>
                                <input type="text" name="profession" id="profession" value="{{ old('profession', $personne->profession) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                       placeholder="Profession">
                            </div>
                            <div class="md:col-span-2">
                                <label for="adresse_exacte" class="block text-sm font-medium text-gray-700 mb-2">Adresse Exacte</label>
                                <textarea name="adresse_exacte" id="adresse_exacte" rows="3" 
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                          placeholder="Adresse complète">{{ old('adresse_exacte', $personne->adresse_exacte) }}</textarea>
                            </div>
                            <div>
                                <label for="numero_cip" class="block text-sm font-medium text-gray-700 mb-2">N° CIP / NPI</label>
                                <input type="text" name="numero_cip" id="numero_cip" value="{{ old('numero_cip', $personne->numero_cip) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                       placeholder="Numéro d'identification">
                            </div>
                            <div>
                                <label for="lieu_delivrance_cip" class="block text-sm font-medium text-gray-700 mb-2">Lieu de délivrance</label>
                                <input type="text" name="lieu_delivrance_cip" id="lieu_delivrance_cip" value="{{ old('lieu_delivrance_cip', $personne->lieu_delivrance_cip) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                       placeholder="Lieu de délivrance du document">
                            </div>
                            <div>
                                <label for="date_delivrance_cip" class="block text-sm font-medium text-gray-700 mb-2">Date de délivrance</label>
                                <input type="date" name="date_delivrance_cip" id="date_delivrance_cip" value="{{ old('date_delivrance_cip', $personne->date_delivrance_cip) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>
                            <div>
                                <label for="date_expiration_cip" class="block text-sm font-medium text-gray-700 mb-2">Date d'expiration</label>
                                <input type="date" name="date_expiration_cip" id="date_expiration_cip" value="{{ old('date_expiration_cip', $personne->date_expiration_cip) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>
                        </div>
                    </div>

                    <div x-show="step === 3" class="space-y-6">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-blue-900 mb-2">Étape 3: Filiation</h3>
                            <p class="text-sm text-blue-700">Informations sur les parents de la personne</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="prenom_pere" class="block text-sm font-medium text-gray-700 mb-2">Prénom du père</label>
                                <input type="text" name="prenom_pere" id="prenom_pere" value="{{ old('prenom_pere', $personne->prenom_pere) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                       placeholder="Prénom du père">
                            </div>
                            <div>
                                <label for="nom_pere" class="block text-sm font-medium text-gray-700 mb-2">Nom du père</label>
                                <input type="text" name="nom_pere" id="nom_pere" value="{{ old('nom_pere', $personne->nom_pere) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                       placeholder="Nom du père">
                            </div>
                            <div>
                                <label for="prenom_mere" class="block text-sm font-medium text-gray-700 mb-2">Prénom de la mère</label>
                                <input type="text" name="prenom_mere" id="prenom_mere" value="{{ old('prenom_mere', $personne->prenom_mere) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                       placeholder="Prénom de la mère">
                            </div>
                            <div>
                                <label for="nom_mere" class="block text-sm font-medium text-gray-700 mb-2">Nom de la mère</label>
                                <input type="text" name="nom_mere" id="nom_mere" value="{{ old('nom_mere', $personne->nom_mere) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                       placeholder="Nom de la mère">
                            </div>
                        </div>
                    </div>

                    <div x-show="step === 4" class="space-y-6">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-blue-900 mb-2">Étape 4: Contact</h3>
                            <p class="text-sm text-blue-700">Informations de contact et photo d'identité</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nationalite" class="block text-sm font-medium text-gray-700 mb-2">Nationalité</label>
                                <input type="text" name="nationalite" id="nationalite" value="{{ old('nationalite', $personne->nationalite) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                       placeholder="Nationalité">
                            </div>
                            <div>
                                <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">
                                    N° de Téléphone <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" name="telephone" id="telephone" value="{{ old('telephone', $personne->telephone) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                       placeholder="Numéro de téléphone" required>
                            </div>
                            <div class="md:col-span-2">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email (facultatif)</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $personne->email) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                       placeholder="adresse@email.com">
                            </div>
                            <div class="md:col-span-2">
                                <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Photo d'identité (optionnel)</label>
                                @if($personne->photo_path)
                                    <div class="mb-4">
                                        <p class="text-sm text-gray-600 mb-2">Photo actuelle :</p>
                                        <img src="{{ asset('storage/'.$personne->photo_path) }}" alt="Photo actuelle" class="w-20 h-20 rounded-lg object-cover border">
                                    </div>
                                @endif
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="photo" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                <span>Changer la photo</span>
                                                <input id="photo" name="photo" type="file" accept="image/png, image/jpeg" class="sr-only">
                                            </label>
                                            <p class="pl-1">ou glisser-déposer</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG jusqu'à 2MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                        <button type="button" x-show="step > 1" @click.prevent="prevStep()" 
                                class="inline-flex items-center px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Précédent
                        </button>

                        <div x-show="step === 1" class="flex-1"></div>

                        <button type="button" x-show="step < 4" @click.prevent="nextStep()" 
                                class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors font-medium">
                            Étape suivante
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>

                        <div x-show="step === 4" class="flex space-x-3">
                            <button type="button" @click.prevent="prevStep()" 
                                    class="inline-flex items-center px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Précédent
                            </button>
                            <button type="submit" 
                                    class="inline-flex items-center px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors font-medium">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Mettre à jour
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
