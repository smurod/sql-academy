<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules';
    protected $fillable = ['course_id', 'title', 'slug', 'description', 'order_index','xp'];

    public function lessons(){
        return $this->hasMany(Lesson::class, 'module_id');
    }
}
