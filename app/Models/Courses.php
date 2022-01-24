<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'name', 'certificate', 'thumbnail', 'type', 'status', 'price',
        'level', 'description', 'mentor_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s'
    ];

    // belongsTo => many to one
    // hasMany => one to many
    public function mentors() 
    {
        return $this->belongsTo('App\Models\Mentors');
    }

    public function chapters() 
    {
        // dalam 1 course, pasti ada banyak chapter
        // data dari chapter di sort ASC -> 1 2 3 4 dst
        return $this->hasMany('App\Models\Chapters')->orderBy('id', 'ASC');
    }

    public function imageCourses() 
    {
        // dalam 1 course, pasti ada banyak chapter
        // data dari imageCourses di sort DESC -> 4 3 2 1
        return $this->hasMany('App\Models\ImageCourses')->orderBy('id', 'DESC');
    }

    // public function myCourses() {
    //     return $this->hasOne('App\Models\MyCourses');
    // }

    // public function reviews() {
    //     return $this->hasMany('App\Models\Reviews');
    // }
}