<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    use HasFactory;

    protected $fillable = [
        'localite_id',
        'eglise_id',
        'admin_createur_id',
        'nom',
        'prenom',
        'date_naissance',
        'lieu_naissance',
        'sexe',
        'situation_matrimoniale',
        'profession',
        'adresse_exacte',
        'nationalite',
        'telephone',
        'email',
        'numero_cip',
        'date_delivrance_cip',
        'lieu_delivrance_cip',
        'date_expiration_cip',
        'photo_path',
        'nom_pere',
        'prenom_pere',
        'nom_mere',
        'prenom_mere',
    ];

    /**
     * 🔑 Ajout des casts pour que Laravel transforme automatiquement
     * ces colonnes en objets Carbon (pour pouvoir utiliser ->format()).
     */
    protected $casts = [
        'date_naissance' => 'date',
        'date_delivrance_cip' => 'date',
        'date_expiration_cip' => 'date',
    ];

    /**
     * Relation : Récupère l'église associée à cette personne.
     */
    public function eglise()
    {
        return $this->belongsTo(Eglise::class);
    }

    /**
     * Relation : Récupère l'admin qui a créé cette personne.
     */
    public function adminCreateur()
    {
        return $this->belongsTo(User::class, 'admin_createur_id');
    }

    /**
     * Relation : Récupère les documents associés à cette personne.
     */
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
