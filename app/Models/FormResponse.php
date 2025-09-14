<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'ip_address',
        'user_agent',
        'responses'
    ];

    protected $casts = [
        'responses' => 'array'
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
