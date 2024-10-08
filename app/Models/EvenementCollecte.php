<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvenementCollecte extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre', 'description', 'lieu', 'date', 'heure', 'participants', 'image', 'user_id'
    ];

    // A user can create many events, but each event belongs to a single user.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // An event can have many reviews.
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
