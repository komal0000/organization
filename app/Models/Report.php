<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'document',
        'sort_order'
    ];

    public static function getOrdered()
    {
        return self::orderBy('sort_order', 'asc')
                   ->orderBy('id', 'desc')
                   ->get();
    }

    public function getFileExtensionAttribute()
    {
        return pathinfo($this->document, PATHINFO_EXTENSION);
    }

    public function getFileSizeAttribute()
    {
        $filePath = public_path($this->document);
        if (file_exists($filePath)) {
            $bytes = filesize($filePath);
            $units = array('B', 'KB', 'MB', 'GB');
            for ($i = 0; $bytes >= 1024 && $i < 3; $i++) {
                $bytes /= 1024;
            }
            return round($bytes, 2) . ' ' . $units[$i];
        }
        return 'Unknown';
    }
}
