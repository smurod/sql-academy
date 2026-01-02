<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = [
        'lesson_id',
        'title',
        'task_text',
        'difficulty',
    ];
 
   public function lesson(){
        return $this->belongsTo(Lesson::class);
    }


   }
