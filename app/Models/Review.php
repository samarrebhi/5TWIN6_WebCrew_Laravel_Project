<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'evenement_collecte_id', // Add this field if it's not already there
        'comment',
        'rating',
        'would_recommend',
        'anonymous',
        'user_id'
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with EvenementCollecte
    public function evenementCollecte()
    {
        return $this->belongsTo(EvenementCollecte::class);
    }
}
