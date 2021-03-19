<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargeIndirecteLine extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function chargeIndirecte()
    {
        return $this->belongsTo(ChargeIndirecte::class, 'charge_indirect_ref', 'ref');
    }
}
