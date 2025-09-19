<?php

namespace App\Http\Controllers;

use App\Models\Personne;
use App\Models\Localite; // Importer le modèle Localite
use App\Models\Eglise;   // Importer le modèle Eglise
use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
    // 1. Autorisation via Policy
    $this->authorize('create', Personne::class);

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
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // 3. Ajout de l'ID de l'admin qui fait l'enregistrement
    $validatedData['admin_createur_id'] = Auth::id();

    // 4. Upload photo si fournie
    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('personnes', 'public');
        $validatedData['photo_path'] = $path;
    }

    // 5. Création de la personne
    $personne = Personne::create($validatedData);

    // 6. Audit log
    AuditLog::create([
        'user_id' => Auth::id(),
        'personne_id' => $personne->id,
        'action' => 'created',
    ]);

    // 7. Redirection vers la page d'upload de documents pour CETTE personne
    return redirect()->route('documents.create', ['personne' => $personne->id])
                     ->with('success', 'Informations principales enregistrées ! Veuillez maintenant ajouter les documents.');
}

            public function index(Request $request)
{
    $user = Auth::user();
    $personnes = null;
    $admins = collect();
    $search = $request->get('search');

    // Construction de la requête de base (exclut les éléments supprimés)
    $query = Personne::with('eglise', 'adminCreateur');

    // Ajout de la recherche si un terme est fourni
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('nom', 'like', "%{$search}%")
              ->orWhere('prenom', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('telephone', 'like', "%{$search}%")
              ->orWhere('numero_cip', 'like', "%{$search}%")
              ->orWhereHas('eglise', function($q) use ($search) {
                  $q->where('nom', 'like', "%{$search}%");
              })
              ->orWhereHas('adminCreateur', function($q) use ($search) {
                  $q->where('name', 'like', "%{$search}%");
              });
        });
    }

    // Filtrage selon le rôle de l'utilisateur
    if ($user->role === 'super_admin') {
        // Le super admin voit toutes les personnes
        $personnes = $query->latest()->paginate(15)->withQueryString();
    } else {
        // Les admins normaux voient seulement leurs propres personnes
        $query->where('admin_createur_id', $user->id);
        $personnes = $query->latest()->paginate(15)->withQueryString();
    }
    
    if ($user->role === 'super_admin') {
        $admins = User::whereIn('role', ['admin','super_admin'])->orderBy('name')->get();
    }

    return view('personnes.index', compact('personnes','admins','search'));
}

    /**
     * Display the specified resource.
     */
    public function show(Personne $personne)
    {
        $this->authorize('view', $personne);

        $personne->load('eglise', 'adminCreateur', 'documents');
        return view('personnes.show', compact('personne'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Personne $personne)
    {
        $this->authorize('update', $personne);

        $localites = Localite::orderBy('nom')->get();
        $eglises = Eglise::orderBy('nom')->get();
        
        return view('personnes.edit', compact('personne', 'localites', 'eglises'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Personne $personne)
    {
        $this->authorize('update', $personne);

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
            'email' => 'nullable|email',
            'numero_cip' => 'nullable|string',
            'date_delivrance_cip' => 'nullable|date',
            'lieu_delivrance_cip' => 'nullable|string',
            'date_expiration_cip' => 'nullable|date',
            'nom_pere' => 'nullable|string',
            'prenom_pere' => 'nullable|string',
            'nom_mere' => 'nullable|string',
            'prenom_mere' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload photo si fournie
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('personnes', 'public');
            $validatedData['photo_path'] = $path;
        }

        $personne->update($validatedData);

        // Audit log
        AuditLog::create([
            'user_id' => Auth::id(),
            'personne_id' => $personne->id,
            'action' => 'updated',
        ]);

        return redirect()->route('personnes.show', $personne)
                         ->with('success', 'Personne mise à jour avec succès !');
    }

    /**
     * Export CSV (super admin only)
     */
    public function exportCsv()
    {
        $this->authorize('export', Personne::class);

        $filename = 'personnes_'.now()->format('Ymd_His').'.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'ID', 'Nom', 'Prénom', 'Église', 'Téléphone', 'Email', 'Créé par', 'Créé le'
            ]);

            Personne::with('eglise', 'adminCreateur')->chunk(500, function ($chunk) use ($handle) {
                foreach ($chunk as $p) {
                    fputcsv($handle, [
                        $p->id,
                        $p->nom,
                        $p->prenom,
                        optional($p->eglise)->nom,
                        $p->telephone,
                        $p->email,
                        optional($p->adminCreateur)->name,
                        optional($p->created_at)->format('Y-m-d H:i:s'),
                    ]);
                }
            });

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Personne $personne)
    {
        $this->authorize('delete', $personne);

        // Audit log avant suppression
        AuditLog::create([
            'user_id' => Auth::id(),
            'personne_id' => $personne->id,
            'action' => 'deleted',
        ]);

        // Supprimer les documents associés
        foreach ($personne->documents as $document) {
            if (Storage::disk('public')->exists($document->chemin_fichier)) {
                Storage::disk('public')->delete($document->chemin_fichier);
            }
        }
        $personne->documents()->delete();

        // Supprimer la photo si elle existe
        if ($personne->photo_path && Storage::disk('public')->exists($personne->photo_path)) {
            Storage::disk('public')->delete($personne->photo_path);
        }

        // Supprimer la personne
        $personne->delete();

        return redirect()->route('personnes.index')
                         ->with('success', 'Personne supprimée avec succès !');
    }
}
