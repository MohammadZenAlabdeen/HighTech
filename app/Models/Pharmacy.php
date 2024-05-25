<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pharmacy extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'state',
    ];

    public function medicine(){
        return $this->hasMany(Medicine::class);
    }
    public function schedule(){
        return $this->hasOne(Schedule::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
