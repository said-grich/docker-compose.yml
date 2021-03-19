<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    use HasFactory;

    protected $fillable = [

        'sites_l',

    ];
    protected $casts = [

        'sites_l' => 'array',
        'sites_locataires' => 'array'

    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
