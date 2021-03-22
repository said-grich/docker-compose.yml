<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preparation extends Model
{
    use HasFactory;

    public function modePreparation()
    {
        return $this->belongsTo(ModePreparation::class);
    }
}
