<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultationFee extends Model
{
    protected $fillable = ['name', 'amount', 'is_active'];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }
}
