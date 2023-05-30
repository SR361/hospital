<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraineeCapacity extends Model
{
    use HasFactory;
    protected $fillable = [
        'units_id',
        'capcaity',
    ];

    public function units()
    {
        return $this->belongsTo(Unit::class, 'units_id');
    }
}
