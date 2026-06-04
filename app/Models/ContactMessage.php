<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'message',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'status' => 'string',
    ];
}
