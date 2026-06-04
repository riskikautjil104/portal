<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentDownload extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'validation_id',
        'user_id',
        'full_name',
        'email',
        'phone',
        'institution',
        'position',
        'fields_json',
        'ip',
        'user_agent',
    ];

    protected $casts = [
        'fields_json' => 'array',
    ];

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    public function validation(): BelongsTo
    {
        return $this->belongsTo(DocumentValidation::class, 'validation_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

