<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionMeasure extends Model
{
    use HasFactory;

    protected $fillable = ['value', 'userId', 'sectionId'];

    const CREATED_AT = "createdAt";
    const UPDATED_AT = "updatedAt";

    public function section()
    {
        return $this->belongsTo(Section::class, 'sectionId', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function pumpMeasures()
    {
        return $this->hasMany(PumpMeasure::class, 'sectionMeasureId', 'id');
    }
}
