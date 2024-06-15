<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['name','surname','nurse_id','user_id','time_visit','room_id'];

    public $timestamps = false;

    public function nurse(): BelongsTo
    {
        return $this->belongsTo(Nurse::class);
    }

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicin::class);
    }
    public function procedure(): HasMany
    {
        return $this->hasMany(Procedure::class);
    }
}
