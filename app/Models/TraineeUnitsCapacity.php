<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraineeUnitsCapacity extends Model
{
    use HasFactory;
    // protected $table = 'trainee_units_capacity';
    protected $primaryKey = 'id';
    protected $fillable = [
        'units_id',
        'training_id',
        'status'
    ];
}
