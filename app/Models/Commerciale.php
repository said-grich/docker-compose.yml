<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commerciale extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'ville',
        'site_id',
    ];
    protected $casts = [

        'site_id' => 'array',

    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
