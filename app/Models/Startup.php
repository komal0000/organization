<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Startup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_of_firm',
        'project_name',
        'year_of_operation',
        'size_of_company',
        'location_of_firm',
        'gender_of_entrepreneurs',
        'sector',
        'status_of_firm'
    ];
}
