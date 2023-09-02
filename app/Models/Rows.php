<?php

namespace App\Models;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rows extends Model
{
    use HasFactory;

    private const DATE_FORMAT = 'd.m.y';
    protected $fillable = [
       'name', 'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];
    protected $dateFormat = self::DATE_FORMAT;

    public $timestamps = false;

    public function getDateAttribute(): string
    {
        return $this->asDateTime($this->attributes['date'])->format(self::DATE_FORMAT);
    }
}
