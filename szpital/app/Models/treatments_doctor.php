<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class treatments_doctor extends Model
{
    use HasFactory;

    protected $fillable = ['procedure_id','doctor_id'];

    public $timestamps = false;

    public function doctor(): HasMany
    {
        return $this->hasMany(doctor::class);
    }
    public function prcedure(): HasMany
    {
        return $this->hasMany(procedure::class);
    }
}
