<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = [
        'division_id',
        'name',
        'short_name',
        'ls_id',
        'status'
    ];

    public function divisions()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function LearningSpecialty()
    {
        return $this->belongsTo(LearningSpecialty::class, 'ls_id');
    }

    public function TraineeCapacity()
    {
        return $this->hasOne(TraineeCapacity::class, 'units_id');
    }
}
