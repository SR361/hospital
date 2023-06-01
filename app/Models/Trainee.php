<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function getImageUrlAttribute()
    {
        if(!isset($this->image)){
            return asset('default.png');
        }else{
            if (File::exists(public_path('public/trainee-image'.$this->image))) {
                return asset('public/trainee-image/'.$this->image);
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
