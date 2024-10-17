<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{

    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'category',
        'center_id',
        'attachement',
        'status',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
