<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
    protected $fillable = [
        'name',
        'surname',
        'phone',
        'email',
        'address',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
