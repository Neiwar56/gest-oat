<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'personne_id',
        'action',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function personne()
    {
        return $this->belongsTo(Personne::class);
    }
}




