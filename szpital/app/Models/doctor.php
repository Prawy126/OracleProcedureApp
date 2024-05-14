<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class doctor extends Model
{
    use HasFactory;
    protected $fillable = ['name','surname','spezialization','license_number','user_id'];

    public $timestamps = false;

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function treatments_doctor(): HasMany
    {
        return $this->hasMany(treatments_doctor::class);
    }
}
