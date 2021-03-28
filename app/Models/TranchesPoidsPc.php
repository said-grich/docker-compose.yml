<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranchesPoidsPc extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function stock()
    {
        return $this->hasMany(StockPoidsPc::class, 'tranche_id', 'uid');
    }

}
