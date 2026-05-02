<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Lesson extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($lesson) {
            if (empty($lesson->slug)) {
                $lesson->slug = Str::slug($lesson->title);
            }
        });
    }

    protected $fillable = [
        'course_id',
        'module_id',
        'title',
        'slug',
        'content',
        'lesson_order',
        'xp',
        'lesson_type'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function progresses()
    {
        return $this->hasMany(LessonProgress::class);
    }
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'lesson_tasks', 'lesson_id', 'task_id')
            ->orderBy('task_order');
    }
}
