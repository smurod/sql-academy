<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'task_id',
        'user_sql',
        'is_correct',
    ];
}
