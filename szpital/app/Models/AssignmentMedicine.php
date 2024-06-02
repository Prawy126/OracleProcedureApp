<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssignmentMedicine extends Model
{
    use HasFactory;

    protected $fillable = ['medicin_id','patient_id','dows','date_start','date_end','expiration_date', 'availability'];

    public $timestamps = false;

    public function patient(): HasMany
    {
        return $this->hasMany(Patient::class);
    }

    public function medicine(): HasMany
    {
        return $this->hasMany(Medicin::class);
    }



}
