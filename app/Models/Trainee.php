<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use File;

class Trainee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'gender',
        'training_id',
        'location',
        'ls_id',
        'units_id',
        'university',
        'start_date',
        'end_date',
    ];

    public function getImageAttribute($value)
    {
        if(!isset($value)){
            return asset('default.png');
        }else{
            if (File::exists(public_path('trainee-image/'.$value))) {
                return asset('trainee-image/'.$value);
            }else{
                return asset('default.png');
            }
        }
    }

    public function LearningSpecialty()
    {
        return $this->belongsTo(LearningSpecialty::class, 'ls_id');
    }
    public function units()
    {
        return $this->belongsTo(Unit::class, 'units_id');
    }
    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id');
    }
}
