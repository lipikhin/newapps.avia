<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_wo',
        'approve',
        'approve_at',
        'unit_id',
        'serial_number',
        'notes',
        'instruction_id',
        'customer_id',
        'open_at',
        'user_id',
        'active',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function instruction()
    {
        return $this->belongsTo(Instruction::class, 'instruction_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
