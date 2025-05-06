<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairPart extends Model
{
    use HasFactory;

    protected $fillable = [
        'repair_id',
        'part_name',
        'quantity',
        'cost',
    ];

    // Зв'язок з ремонтом (якщо є)
    public function repair()
    {
        return $this->belongsTo(Repair::class);
    }
}
