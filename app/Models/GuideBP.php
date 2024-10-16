<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideBP extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'title',             // Title of the guide
        'content',           // Content or description of the guide
        'category',          // Category (e.g., Recycling, Waste Management, Environmental Awareness)
       'image',             // image related to the guide
        'external_links',    // Related external resources or links
        'tags',// Tags to help categorize the guide (e.g., plastic recycling, composting)
    ];
}
