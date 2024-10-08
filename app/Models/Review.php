<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'evenement_collecte_id', 'user_id', 'comment', 'rating'
    ];

    public function evenement()
    {
        return $this->belongsTo(EvenementCollecte::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }}
