<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


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
       // Relationship with Center
       public function Centers()
       {
           return $this->hasMany(Center::class);
       }
       // Relationship with reclamation
       public function Claims()
       {
           return $this->hasMany(Claim::class);
       }
}
