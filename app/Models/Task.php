<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'task_number',
        'lesson_id',
        'author_id',
        'title',
        'description',
        'task_text',
        'database_schema',
        'solution_sql',
        'expected_results',
        'difficulty_percent',
        'is_free',
        'hint',
        'points',
        'sql_type',
        'task_order',
        'tags',
        'company',
    ];

    // Преобразование типов (важно для is_free как boolean и expected_results как json)
    protected $casts = [
        'is_free' => 'boolean',
        'difficulty_percent' => 'integer',
        'points' => 'integer',
        'task_order' => 'integer',
        'lesson_id' => 'integer',
        'author_id' => 'integer',
        'expected_results' => 'array', // Laravel автоматически сериализует JSON
    ];

    // ==================
    // Связи
    // ==================

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // ==================
    // Аксессоры
    // ==================

    /**
     * Человекочитаемый уровень сложности
     */
    public function getDifficultyLabelAttribute(): string
    {
        return match (true) {
            $this->difficulty_percent <= 30  => 'Лёгкая',
            $this->difficulty_percent <= 60  => 'Средняя',
            $this->difficulty_percent <= 85  => 'Сложная',
            default                          => 'Экспертная',
        };
    }

    /**
     * Определяет, модифицирующий ли это запрос
     */
    public function isDml(): bool
    {
        return in_array($this->sql_type, ['insert', 'update', 'delete']);
    }
}
