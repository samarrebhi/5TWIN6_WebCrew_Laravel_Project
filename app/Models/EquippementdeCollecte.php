<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Center;

class EquippementdeCollecte extends Model
{
    use HasFactory;

    // Attributs qui peuvent être massivement assignés
    protected $fillable = [
        'nom',          // Nom de l'équipement
        'statut',       // Statut de l'équipement (actif, en maintenance, hors service)
        'capacite',     // Capacité de l'équipement (ex. en litres ou kilogrammes)
        'emplacement',   // Emplacement actuel de l'équipement
          'image',
          'user_id',
          'center_id', // Assurez-vous que cela est inclus si ce n'est pas déjà fait

    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function center()
    {
        return $this->belongsTo(Center::class);
    }
   
}
