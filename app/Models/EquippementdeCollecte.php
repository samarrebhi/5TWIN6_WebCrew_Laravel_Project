<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquippementdeCollecte extends Model
{
    use HasFactory;

    // Attributs qui peuvent être massivement assignés
    protected $fillable = [
        'nom',          // Nom de l'équipement
        'statut',       // Statut de l'équipement (actif, en maintenance, hors service)
        'capacite',     // Capacité de l'équipement (ex. en litres ou kilogrammes)
        'emplacement',   // Emplacement actuel de l'équipement
    ];
}