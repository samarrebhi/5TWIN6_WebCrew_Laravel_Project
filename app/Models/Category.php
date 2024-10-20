<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;


class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',              
        'quantity',      
        'state' , //whether it's solid,liquid,electronic.....    
        'environmental_impact',        //whether it's low,moderate,high,polluting,biodegradable
        'user_id',


    ];

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'category_reservation')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }


 // Relationship with User
 public function user()
 {
     return $this->belongsTo(User::class);
 }


    
}
