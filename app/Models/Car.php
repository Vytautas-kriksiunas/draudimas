<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Car extends Model
{
    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
    protected $fillable = [
        'reg_number',
        'brand',
        'model',
        'owner_id',
    ];
    public function photos()
    {
        return $this->hasMany(CarPhoto::class);
    }
}
