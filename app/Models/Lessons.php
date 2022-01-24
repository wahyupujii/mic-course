<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lessons extends Model
{
    use HasFactory;

    protected $table = 'lessons';

    protected $fillable = [
        'name', 'video', 'chapter_id'
    ];

    // ngga dibutuhkan karena ngga perlu ambil data si chapter
    // public function chapters()
    // {
    //     return $this->belongsTo('App\Models\Chapters');
    // }
}
