<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class treatments_nurse extends Model
{
    use HasFactory;

    protected $fillable = ['nurse_id','procedure_id'];

    public $timestamps = false;

    public function procedure(): HasMany
    {
        return $this->hasMany(procedure::class);
    }

    public function nurse(): HasMany
    {
        return $this->hasMany(nurse::class);
    }

}
