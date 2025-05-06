<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'car_id',
        'description',
        'cost',
        'repair_date',
    ];

    // Зв'язок з клієнтом (якщо є)
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Зв'язок з машиною (якщо є)
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
