<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideBP extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'title',
        'body',
        'category',
       'image',
        'external_links',
        'tags',
        'user_id',

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $table = 'guide_b_p_s';
    public function sondages()
    {
        return $this->hasMany(Sondage::class);
    }


}
