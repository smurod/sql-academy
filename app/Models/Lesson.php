<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'module_id',
        'title',
        'slug',
        'content',
        'lesson_order',
        'lesson_type'
    ];

    protected $casts = [
        'content' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($lesson) {
            if (empty($lesson->slug)) {
                $lesson->slug = Str::slug($lesson->title);
            }
        });
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getLectureAttribute() { return $this->content['lecture'] ?? null; }
    public function getCodeAttribute() { return $this->content['code'] ?? null; }
    public function getPresentationAttribute() { return $this->content['presentation'] ?? null; }
    public function getVideoAttribute() { return $this->content['video'] ?? null; }

    public function hasCode(): bool { return !empty($this->getCodeAttribute()); }
    public function hasPresentation(): bool { return !empty($this->getPresentationAttribute()); }
    public function hasVideo(): bool { return !empty($this->getVideoAttribute()); }
}
