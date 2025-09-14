<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'year',
        'description',
        'slug',
        'is_active',
        'settings'
    ];

    protected $casts = [
        'settings' => 'array',
        'is_active' => 'boolean'
    ];

    public function fields()
    {
        return $this->hasMany(FormField::class)->orderBy('order');
    }

    public function responses()
    {
        return $this->hasMany(FormResponse::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title . '-' . $model->year);
            }
        });
    }
}
