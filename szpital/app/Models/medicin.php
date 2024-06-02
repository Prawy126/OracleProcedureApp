<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medicin extends Model
{
    use HasFactory;
    protected $fillable = ['name','instruction','warehouse_quantity','drug_category','price','dose_unit'];

    public $timestamps = false;

    public function assigment_medicine(): HasMany
    {
        return $this->hasMany(AssignmentMedicine::class);
    }


}
