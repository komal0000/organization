<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_key',
        'section_name',
        'content_type',
        'content',
        'description',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public static function getContent($sectionKey)
    {
        $content = self::where('section_key', $sectionKey)
                      ->where('is_active', true)
                      ->first();

        return $content ? $content->content : '';
    }

    public static function getAllActiveContent()
    {
        return self::where('is_active', true)
                   ->orderBy('order')
                   ->get()
                   ->keyBy('section_key');
    }
}
