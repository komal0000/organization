<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image', 
        'link',
        'sort_order',
    ];

    public static function getOrdered()
    {
        return self::orderBy('sort_order', 'asc')
                   ->orderBy('id', 'asc')
                   ->get();
    }
}
