<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sondage extends Model
{
    use HasFactory;
    // Enable automatic management of created_at and updated_at timestamps
    public $timestamps = true;

    // Default values for certain attributes
    //protected $attributes = [
      //  'response_count' => 0, // Default value for response count
    //];
    protected $fillable = [
        'title',              // Title of the survey
        'description',        // Description of the survey
        'questions',          // Array or JSON format for questions
        'start_date',         // Survey start date
        'end_date',           // Survey end date
        'category',         //e.g., Recycling, Waste Management, Environmental Awareness)
        'location',


    ];
}
