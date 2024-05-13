<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class assignment_medicine extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id','medicin_id','dows','date_start','date_end','expiration_date', 'availability'];

    public $timestamps = false;

    public function patient(): BelongsTo
    {
        return $this->belongsTo(patient::class);
    }

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(medicin::class);
    }

}
