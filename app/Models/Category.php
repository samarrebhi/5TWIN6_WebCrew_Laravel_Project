<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',              
        'quantity',      
        'state' , //whether it's solid,liquid,electronic.....    
        'environmental_impact',        //whether it's low,moderate,high,polluting,biodegradable
    

    ];
}
