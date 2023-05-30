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
        'ls',
    ];

    public function divisions()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
}
