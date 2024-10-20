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
    ];

     public function equipements()
    {
        return $this->hasMany(EquippementdeCollecte::class);
    }
}
