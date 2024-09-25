<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvenementCollecte extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre', 'description', 'lieu', 'date', 'heure', 'participants', 'image'
    ];
}
