<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ApiToken extends Model
{
    protected $fillable = ['token'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public static function generateToken()
    {
        return Str::random(80);
    }
}
