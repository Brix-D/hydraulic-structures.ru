<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'warningValue', 'maximumValue', 'reservoirId'];

    const CREATED_AT = "createdAt";
    const UPDATED_AT = "updatedAt";

    public function reservoir()
    {
        return $this->belongsTo(Reservoir::class, 'reservoirId', 'id');
    }

    public function pumps()
    {
        return $this->hasMany(Pump::class, 'sectionId', 'id');
    }

    public function sectionMeasures()
    {
        return $this->hasMany(SectionMeasure::class, 'sectionId', 'id')
    }
}
