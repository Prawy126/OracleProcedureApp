<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TreatmentDoctor extends Model
{
    use HasFactory;


    protected $table = 'TREATMENTS_DOCTORS';
    protected $fillable = ['doctor_id','procedure_id'];

    public $timestamps = false;

    public function doctor(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }
    public function prcedure(): HasMany
    {
        return $this->hasMany(Procedure::class);
    }
}
