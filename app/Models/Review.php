<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'evenement_collecte_id',
        'comment',
        'rating',
        'user_id',
    ];

    public function evenement()
    {
        return $this->belongsTo(EvenementCollecte::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }}
