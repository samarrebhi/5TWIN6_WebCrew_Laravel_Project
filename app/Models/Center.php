<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EquippementdeCollecte;

class Center extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'email',
        'phone',
        'address',
        'image',
        'user_id',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function Claims()
    {
        return $this->hasMany(Claim::class);
    }
    
        public function equipements()
    {
        return $this->hasMany(EquippementdeCollecte::class);
    }
}
