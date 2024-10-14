<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'approve',
        'approve_at',
        'units_id',
        'serial_number',
        'notes',
        'instructions_id',
        'customers_id',
        'open_at',
        'users_id',
        'active',
    ];
    public function units()
    {
        return $this->belongsTo(Unit::class,'units_id');
    }
    public function instruction()
    {
        return $this->belongsTo(Instruction::class,'instructions_id');
    }
    public function customer()
    {
        return $this->belongsTo(Instruction::class,'customers_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }
}
