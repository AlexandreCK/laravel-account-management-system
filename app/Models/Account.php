<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['name', 'reference', 'type', 'docs'];

    protected $casts = [
        'docs' => 'array',
    ];

    const TYPES = ['Admin', 'User', 'Guest'];

    public static function getTypes()
    {
        return self::TYPES;
    }
}

