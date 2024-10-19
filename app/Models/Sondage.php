<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sondage extends Model
{
    use HasFactory;
    // Enable automatic management of created_at and updated_at timestamps
    public $timestamps = true;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $fillable = [
        'title',
        'description',
        'questions',
        'start_date',
        'end_date',
        'category',
        'user_id',
        'guide_bp_id',

    ];
    protected $casts = [
        'questions' => 'array', // Cast to array for easier access

    ];
    protected $table = 'sondages';
    public function guide()
    {
        return $this->belongsTo(GuideBP::class,'guide_bp_id','id');
    }

}
