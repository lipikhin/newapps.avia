<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = [
        'part_number',
        'verified',
        'manuals_id',
    ];

    public function manuals()
    {
        return $this->belongsTo(Manual::class,'manuals_id');
    }
    public function work_orders()
    {
        return $this->hasMany(Manual::class,'work_orders_id');
    }

}
