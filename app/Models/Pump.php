<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pump extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'sectionId', 'pumpId'];

    const CREATED_AT = "createdAt";
    const UPDATED_AT = "updatedAt";

    public function section()
    {
        return $this->belongsTo(Section::class, 'sectionId', 'id');
    }

    public function pumpMeasures()
    {
        return $this->hasMany(PumpMeasure::class, 'pumpId', 'id');
    }
}
