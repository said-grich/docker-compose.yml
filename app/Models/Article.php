<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [

        'fournisseur_id',

    ];
    protected $casts = [

        'fournisseur_id' => 'array',

    ];

    /* public function famille()
     {
         return $this->hasOne(Famille::class);
     } */
    public function famille()
    {
        return $this->belongsTo(Famille::class);
    }
    public function sousFamille()
    {
        return $this->belongsTo(SousFamille::class);
    }

    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }

    public function uniteAchat()
    {
        return $this->belongsTo(Unite::class, 'unite_achat_id', 'id');
    }

    public function uniteVente()
    {
        return $this->belongsTo(Unite::class, 'unite_vente_id', 'id');
    }


    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
    public function produits()
    {
        return $this->belongsToMany(Produit::class);
    }

    /*public function tva()
    {
        return $this->belongsTo(Tva::class);
    }*/
}
