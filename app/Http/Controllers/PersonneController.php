<?php

namespace App\Http\Controllers;

use App\Models\Personne;
use App\Models\Localite; // Importer le modèle Localite
use App\Models\Eglise;   // Importer le modèle Eglise
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PersonneController extends Controller
{
    use AuthorizesRequests;
    /**
     * Affiche le formulaire pour créer une nouvelle personne.
     */
    public function create()
    {
        // On récupère toutes les localités et églises, triées par nom
        $localites = Localite::orderBy('nom')->get();
        $eglises = Eglise::orderBy('nom')->get();

        // On retourne la vue en lui passant les listes
        return view('personnes.create', compact('localites', 'eglises'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // 1. Autorisation : on vérifie que l'utilisateur est un 'admin'
    $this->authorize('is-admin');

    // 2. Validation côté serveur : c'est la validation de sécurité, elle est obligatoire !
    $validatedData = $request->validate([
        'localite_id' => 'required|exists:localites,id',
        'eglise_id' => 'required|exists:eglises,id',
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'date_naissance' => 'required|date',
        'lieu_naissance' => 'required|string',
        'sexe' => 'required|string',
        'situation_matrimoniale' => 'required|string',
        'profession' => 'required|string',
        'adresse_exacte' => 'required|string',
        'nationalite' => 'required|string',
        'telephone' => 'required|string',
        // Champs optionnels
        'email' => 'nullable|email',
        'numero_cip' => 'nullable|string',
        'date_delivrance_cip' => 'nullable|date',
        'lieu_delivrance_cip' => 'nullable|string',
        'date_expiration_cip' => 'nullable|date',
        'nom_pere' => 'nullable|string',
        'prenom_pere' => 'nullable|string',
        'nom_mere' => 'nullable|string',
        'prenom_mere' => 'nullable|string',
    ]);

    // 3. Ajout de l'ID de l'admin qui fait l'enregistrement
    $validatedData['admin_createur_id'] = Auth::id();

    // 4. Création de la personne dans la base de données
    $personne = Personne::create($validatedData);

    // 5. Redirection vers la page d'upload de documents pour CETTE personne
    return redirect()->route('documents.create', ['personne' => $personne->id])
                     ->with('success', 'Informations principales enregistrées ! Veuillez maintenant ajouter les documents.');
}

            public function index()
{
    $user = Auth::user();
    $personnes = null;

    if ($user->role === 'super_admin') {
        // Le Super Admin voit tout le monde, avec les infos de l'église et de l'admin créateur
        $personnes = Personne::with('eglise', 'adminCreateur')->latest()->paginate(15);
    } else {
        // L'admin simple ne voit que les personnes qu'il a créées
        $personnes = Personne::where('admin_createur_id', $user->id)
                            ->with('eglise')
                            ->latest()
                            ->paginate(15);
    }

    return view('personnes.index', compact('personnes'));
}
}
