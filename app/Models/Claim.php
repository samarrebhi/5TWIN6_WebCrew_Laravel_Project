<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
///
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'category',
        'center_id',
        'attachment',
        'status',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function Center()
    {
        return $this->belongsTo(Center::class);
    }
}
