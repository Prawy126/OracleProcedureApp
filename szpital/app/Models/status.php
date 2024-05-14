<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class status extends Model
{
    use HasFactory;


    protected $fillable = ['status','description'];

    public $timestamps = false;

    public function procedure(): HasMany
    {
        return $this->hasMany(procedure::class);
    }

}
