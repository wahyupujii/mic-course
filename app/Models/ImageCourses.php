<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageCourses extends Model
{
    use HasFactory;

    protected $table = 'image_courses';

    protected $fillable = [
        'course_id', 'image'
    ];

    // ngga perlu ada method relasi, karena di model Course sudah dibuat
}
