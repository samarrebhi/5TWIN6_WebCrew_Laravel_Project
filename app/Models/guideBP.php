<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guideBP extends Model
{
    use HasFactory;
    // Enable automatic management of created_at and updated_at timestamps
    public $timestamps = true;
    protected $fillable = [
'title',              // Title of the guide
'description',        // Description of the guide
'content',            // Main content or body of the guide (can be HTML formatted)

'category',           // Category of the best practices (e.g., Waste Management, Recycling, etc.)
'author',             // Author of the guide
'status',];  // Status of the guide (e.g., published, draft)]
}
