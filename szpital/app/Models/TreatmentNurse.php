<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TreatmentNurse extends Model
{
    use HasFactory;

    protected $table = 'TREATMENTS_NURSES';
    protected $fillable = ['nurse_id', 'procedure_id'];
    public $timestamps = false;

    public function procedure(): HasMany
    {
        return $this->hasMany(Procedure::class);
    }

    public function nurse(): HasMany
    {
        return $this->hasMany(Nurse::class);
    }

}
