<?php

namespace App\Http\Controllers;

use App\Models\Personne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Pour enregistrer les erreurs

class DocumentController extends Controller
{
    /**
     * Affiche le formulaire d'upload de documents pour une personne donnée.
     */
    public function create(Personne $personne)
    {
        return view('documents.create', compact('personne'));
    }

    /**
     * Valide et enregistre les documents uploadés.
     */
    public function store(Request $request, Personne $personne)
    {
        // 1. Validation des fichiers
        $request->validate([
            'photo' => 'required|image|max:2048', // Doit être une image (jpg, png...), max 2Mo
            'cip' => 'required|mimes:pdf|max:2048', // Doit être un PDF, max 2Mo
            'passeport' => 'nullable|mimes:pdf|max:2048', // Optionnel, mais si présent, doit être un PDF
        ]);

        try {
            // 2. Traitement de la photo
            if ($request->hasFile('photo')) {
                // On stocke le fichier et on récupère son chemin
                $path = $request->file('photo')->store('personnes', 'public');
                // On met à jour la photo dans la table personnes
                $personne->update(['photo_path' => $path]);
                // On enregistre aussi le chemin dans la table documents
                $personne->documents()->create([
                    'type_document' => 'photo',
                    'chemin_fichier' => $path,
                ]);
            }

            // 3. Traitement du CIP
            if ($request->hasFile('cip')) {
                $path = $request->file('cip')->store('documents/cips', 'public');
                $personne->documents()->create([
                    'type_document' => 'cip',
                    'chemin_fichier' => $path,
                ]);
            }

            // 4. Traitement du passeport (s'il existe)
            if ($request->hasFile('passeport')) {
                $path = $request->file('passeport')->store('documents/passeports', 'public');
                $personne->documents()->create([
                    'type_document' => 'passeport',
                    'chemin_fichier' => $path,
                ]);
            }
        } catch (\Exception $e) {
            // En cas d'erreur, on la logue et on redirige avec un message d'échec
            Log::error("Erreur d'upload de fichier: " . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'upload des fichiers: ' . $e->getMessage());
        }

        return redirect()->route('personnes.index')->with('success', 'Personne et documents enregistrés avec succès !');
    }
}
