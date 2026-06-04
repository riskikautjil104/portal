<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'description',
        'male_count',
        'female_count',
        'active_count',
        'alumni_count',
    ];

    protected $casts = [
        'latitude' => 'double',
        'longitude' => 'double',
        'male_count' => 'integer',
        'female_count' => 'integer',
        'active_count' => 'integer',
        'alumni_count' => 'integer',
    ];
}
