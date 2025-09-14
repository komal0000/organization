<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'type',
        'label',
        'name',
        'description',
        'placeholder',
        'options',
        'is_required',
        'order',
        'validation_rules'
    ];

    protected $casts = [
        'options' => 'array',
        'validation_rules' => 'array',
        'is_required' => 'boolean'
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
