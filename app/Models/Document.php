<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'personne_id',
        'type_document',
        'chemin_fichier',
    ];

    /**
     * Récupère la personne associée à ce document.
     */
    public function personne()
    {
        return $this->belongsTo(Personne::class);
    }
}
