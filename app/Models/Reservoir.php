<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservoir extends Model
{
    use HasFactory;


    protected $fillable = ['name'];

    const CREATED_AT = "createdAt";
    const UPDATED_AT = "updatedAt";

    public function sections()
    {
        return $this->hasMany(Section::class, 'reservoirId', 'id');
    }
}
