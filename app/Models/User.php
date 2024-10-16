<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Blog;
use App\Models\Reservation;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function likedBlogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_likes', 'user_id', 'blog_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


      // Relationship with EvenementCollecte
      public function evenementCollectes()
      {
          return $this->hasMany(EvenementCollecte::class);
      }
  
      // Relationship with Review
      public function reviews()
      {
          return $this->hasMany(Review::class);
      }
}
