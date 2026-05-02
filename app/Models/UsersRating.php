<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersRating extends Model
{
    use HasFactory;
    protected $table = 'users_rating';
    protected $fillable = ['user_id','type','source_id','xp','coins'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
