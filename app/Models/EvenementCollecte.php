<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvenementCollecte extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre', 'description', 'lieu', 'date', 'heure', 'participants', 'image',
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
}
