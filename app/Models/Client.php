<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    const STATUTS = [
        'lead' => 'Lead',
        'active'=> 'Active',
        'non-active'=> 'Non Active'
    ];

    protected $fillable = [
        'name',
        'phone',
        'ville',
    ];

    protected $casts = [
        'tags' => 'array'
    ];

    public function client()
    {
        return $this->hasMany(Devis::class);
    }
}
