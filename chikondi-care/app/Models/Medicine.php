<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = ['name', 'dosage_form', 'strength', 'stock_quantity', 'is_active'];

    protected function casts(): array
    {
        return [
            'stock_quantity' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
