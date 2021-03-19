<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargeLine extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'montant_ht' => 'array',
        'montant_tva' => 'array',
        'montant_ttc' => 'array',
        'ventilation' => 'array',
        'compte_comptable_ht_id' => 'array',
        'compte_comptable_Tva_id' => 'array',
    ];


    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
    public function charge()
    {
        return $this->belongsTo(Charge::class, 'charge_ref', 'ref');
    }
}
