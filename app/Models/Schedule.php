<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable=[
        'open',
        'close',
    ];
    public function pharmacy(){
        return $this->belongsTo(Pharmacy::class);
    }
}
