<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class procedure extends Model
{
    use HasFactory;

    protected $fillable = ['treatment_type_id','room_id','date','time','cost','status'];

    public $timestamps = false;

    public function room(): HasOne
    {
        return $this->hasOne(room::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(status::class);
    }

    public function treatments_nurse(): HasMany
    {
        return $this->hasMany(treatments_nurse::class);
    }
    public function treatmens_doctor(): HasMany
    {
        return $this->hasMany(treatments_doctor::class);
    }

    public function treatment_type(): BelongsTo
    {
        return $this->belongsTo(treatment_type::class);
    }
}
