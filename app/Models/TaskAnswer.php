<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAnswer extends Model
{
    protected $fillable = [
        'task_id',
        'correct_sql',
        'explanation',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
