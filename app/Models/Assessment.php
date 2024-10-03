<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'name',
        'instruction',
        'number_of_reviews',
        'max_score',
        'due_date',
        'due_time',
        'type'
    ];

    protected $casts = [
        'due_date' => 'date',
        'due_time' => 'datetime:H:i', // Casts to time in "Hour:Minute" format
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
