<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class patient extends Model
{
    use HasFactory;

    protected $fillable = ['name','surname','nurse_id','user_id','time_visit','room_id'];

    public $timestamps = false;

    public function nurse(): BelongsTo
    {
        return $this->belongsTo(nurse::class);
    }

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(medicin::class);
    }
}
