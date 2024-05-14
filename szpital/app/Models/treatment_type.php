<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class treatment_type extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','recommendations_before_surgery','recommendations_after_surgery'];

    public $timestamps = false;

    public function procedure(): HasMany
    {
        return $this->hasMany(procedure::class);
    }

}
