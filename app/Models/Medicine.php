<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'company',
        'count',
    ];
    public function pharmacy(){
        return $this->belongsTo(Pharmacy::class);
    }
}
