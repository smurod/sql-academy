<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'theory_text',
        'lesson_order',
    ];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }




    public function isJsonContent(): bool
    {
        if (!is_string($this->theory_text)) {
            return false;
        }

        json_decode($this->theory_text);
        return json_last_error() === JSON_ERROR_NONE;
    }


    public function content(): array
    {
        if ($this->isJsonContent()) {
            return json_decode($this->theory_text, true) ?? [];
        }

        // Старый формат — просто лекция
        return [
            'lecture' => $this->theory_text,
        ];
    }


    public function lecture(): ?string
    {
        return $this->content()['lecture'] ?? null;
    }

    public function code(): ?string
    {
        return $this->content()['code'] ?? null;
    }

    public function presentation(): ?string
    {
        return $this->content()['presentation'] ?? null;
    }

    public function video(): ?string
    {
        return $this->content()['video'] ?? null;
    }


    public function hasCode(): bool
    {
        return !empty($this->code());
    }

    public function hasPresentation(): bool
    {
        return !empty($this->presentation());
    }

    public function hasVideo(): bool
    {
        return !empty($this->video());
    }

}
