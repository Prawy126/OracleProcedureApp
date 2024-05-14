<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class room extends Model
{
    use HasFactory;

    protected $fillable = ['number','location','status','type_room'];

    public $timestamps = false;

    public function procedure(): HasOne
    {
        return $this->hasOne(procedure::class);
    }

    public function patients(): HasMany
    {
        return $this->hasMany(patient::class);
    }

}
