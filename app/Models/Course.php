<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'title',
        'description',
        'level',
        'start_date',
        'duration',
        'image',
        'extra_info',
    ];
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
