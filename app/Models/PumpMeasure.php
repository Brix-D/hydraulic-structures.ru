<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PumpMeasure extends Model
{
    use HasFactory;

    protected $fillable = ['state', 'userId', 'pumpId', 'sectionMeasureId'];

    const CREATED_AT = "createdAt";
    const UPDATED_AT = "updatedAt";

    public function sectionMeasure()
    {
        return $this->belongsTo(SectionMeasure::class, 'sectionMeasureId', 'id');
    }

    public function pump()
    {
        return $this->belongsTo(Pump::class, 'pumpId', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}
