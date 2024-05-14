<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class assignment_medicine extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id','medicin_id','dows','date_start','date_end','expiration_date', 'availability'];

    public $timestamps = false;

    public function patient(): HasMany
    {
        return $this->hasMany(patient::class);
    }

    public function medicine(): HasMany
    {
        return $this->hasMany(medicin::class);
    }



}
