<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Nurse extends Model
{
    use HasFactory;

    protected $fillable = ['name','surname','number','user_id'];

    public $timestamps = false;

    public function patient(): HasMany
    {
        return $this->hasMany(Patient::class);
    }

    public function treatment_nurse(): HasMany
    {
        return $this->hasMany(TreatmentNurse::class);
    }
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
