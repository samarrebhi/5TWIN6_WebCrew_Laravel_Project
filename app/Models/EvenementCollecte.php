<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvenementCollecte extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom', 'date', 'lieu', 'organisateur_id'
    ];
    public function organisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'organisateur_id');
    }
}
