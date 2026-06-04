<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'title',
        'description',
        'file_path',
        'file_name',
        'file_type',
        'file_mime',
        'active',
        'requires_validation',
        'validation_fields_json',
        'download_total',
    ];

    protected $casts = [
        'active' => 'boolean',
        'requires_validation' => 'boolean',
        'validation_fields_json' => 'array',
    ];

    public function validations(): HasMany
    {
        return $this->hasMany(DocumentValidation::class);
    }

    public function downloads(): HasMany
    {
        return $this->hasMany(DocumentDownload::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

