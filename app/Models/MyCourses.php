<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyCourses extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'course_id', 'user_id'
    ];

    public function courses() 
    {
        return $this->belongsTo('App\Models\Courses');
    }
}
