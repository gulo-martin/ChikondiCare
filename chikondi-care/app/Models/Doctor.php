<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doctor extends Model
{
    protected $fillable = ['user_id', 'doctor_number', 'name', 'telephone', 'room_number', 'employment_type', 'next_visit_date', 'next_visit_duration', 'is_active'];

    protected function casts(): array
    {
        return [
            'next_visit_date' => 'date',
            'next_visit_duration' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
