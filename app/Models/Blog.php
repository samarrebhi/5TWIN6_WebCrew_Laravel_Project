<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\BlogLike;

class Blog extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   
        // Ajoute une méthode pour obtenir les utilisateurs qui aiment le blog

        public function likedByUsers()
    {
            return $this->belongsToMany(User::class, 'blog_likes')
                ->select('users.id as user_id', 'users.email')
                ->withPivot('blog_id'); // Sélectionner uniquement les colonnes nécessaires
    }

    // Dans le modèle Blog
public function likes()
{
    return $this->belongsToMany(User::class, 'blog_likes')->select('email'); // Récupère uniquement les emails
}


        
}
