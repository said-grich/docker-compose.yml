<?php

namespace App\Http\Livewire\Vente;

use App\Models\Categorie;
use App\Models\Produit;
use App\Models\ProduitPrix;
use App\Models\SousCategorie;
use App\Models\Stock;
use App\Models\Tranche;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ModificationPrix extends Component
{
    public $produit =  [];

    public $nom_produit;
    public $id_produit;
    public $liste_produits =  [];
    public $prix_n = [];
    public $prix_f = [];
    public $prix_p = [];
    public $produit_id = [];
    public $liste_categories = [];
    public $liste_sous_categories = [];
    public $liste_tranches = [];
    public $historique_prix = [];
    public $nom_categorie;
    public $nom_tranche;
    public $qte_stock = [];


    public $filter = [
        "categorie" => "",
        "sousCategorie" => "",
        "tranche" => "",
    ];

    public $sortBy = 'produit_id';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];


    public function loadList($produit){
        $this->liste_produits = Stock::when($this->filter['categorie'], function ($query) {
            $query->where('categorie_id', $this->filter['categorie']);
        })
        ->when($this->filter['sousCategorie'], function ($query) {
            $query->where('sous_categorie_id', $this->filter['sousCategorie']);
        })
        ->when($this->filter['tranche'], function ($query) {
            $query->where('tranche_id', $this->filter['tranche']);
        })

        ->where('produit_id',$produit)
        ->where('qte_restante', '!=',0)
        ->orderBy('created_at')
        ->get()
        ->groupBy(['tranche_id', 'categorie_id'])->toArray();

        foreach ($this->liste_produits as $tranche => $categories) {
            $this->nom_tranche[$tranche] = Tranche::where('uid', $tranche)->first()->nom;
            foreach ($categories as $categorie => $stock) {
                $this->nom_categorie[$categorie] = Categorie::where('id', $categorie)->first()->nom;
                $this->prix_n[$tranche][$categorie] = $stock[0]['prix_n'];
                $this->prix_f[$tranche][$categorie] = $stock[0]['prix_f'];
                $this->prix_p[$tranche][$categorie] = $stock[0]['prix_p'];
                $this->qte_stock[strval($tranche)][$categorie] = Stock::selectRaw("SUM(qte_restante) as stock")->where('tranche_id', $tranche)->where('categorie_id', $categorie)->first()->stock;

            }


        }
        //dd($this->stock["PP16187570797261627"]["1"]);


        // foreach ($this->liste_produits as $key => $value) {
        //     $this->prix_n[$value->id] = $value->prix_n;
        //     $this->prix_f[$value->id] = $value->prix_f;
        //     $this->prix_p[$value->id] = $value->prix_p;
        // }
    }



    public function modificationPrix($produit){
        $this->id_produit = $produit;
        $this->nom_produit = Produit::where('id',$produit)->first()->nom;
       // $this->liste_produits = Stock::where('produit_id',$produit)->where('qte_restante','!=',0)->get();

        $categories = Stock::where('produit_id',$produit)->where('qte_restante','!=',0)->get()->pluck('categorie_id')->unique();
        $sous_categories = Stock::where('produit_id',$produit)->where('qte_restante','!=',0)->get()->pluck('sous_categorie_id')->unique();
        $tranches = Stock::where('produit_id',$produit)->where('qte_restante','!=',0)->get()->pluck('tranche_id')->unique();

        $this->liste_categories = Categorie::whereIn('id',$categories)->get();
        $this->liste_sous_categories = SousCategorie::whereIn('id',$sous_categories)->get();
        $this->liste_tranches = Tranche::whereIn('uid',$tranches)->get();

        $this->loadList($produit);

        $this->historique_prix = ProduitPrix::where('produit_id', $produit)->orderBy('created_at', 'DESC')->get();

        /* $this->liste_produits = Stock::when($this->filter['categorie'], function ($query) {
                $query->where('categorie_id', $this->filter['categorie']);
            })
            ->when($this->filter['sous_categorie'], function ($query) {
                $query->where('sous_categorie_id', $this->filter['sous_categorie']);
            })
            ->when($this->filter['tranche'], function ($query) {
                $query->where('tranche_id', $this->filter['tranche']);
            })

            ->where('produit_id',$produit)
            ->where('qte_restante', '!=',0)
            ->get(); */

    }

    public function updatedFilterCategorie(){
        $this->loadList($this->id_produit);
    }

    public function updatedFilterSousCategorie(){
        $this->loadList($this->id_produit);
    }

    public function updatedFilterTranche(){
        $this->loadList($this->id_produit);
    }

    public function edit($produit_id,$tranche_id,$categorie_id){

        DB::transaction(function() use ($produit_id,$categorie_id,$tranche_id) {
            Stock::where('produit_id', $produit_id)
            ->where('tranche_id', $tranche_id)
            ->where('categorie_id', $categorie_id)
            ->update([
                'prix_n' => $this->prix_n[$tranche_id][$categorie_id],
                'prix_f' => $this->prix_f[$tranche_id][$categorie_id],
                'prix_p' => $this->prix_p[$tranche_id][$categorie_id],
            ]);
            ProduitPrix::create([
                'produit_id' => $produit_id,
                'categorie_id' => $categorie_id,
                'tranche_id' => $tranche_id,
                'prix_n' => $this->prix_n[$tranche_id][$categorie_id],
                'prix_f' => $this->prix_f[$tranche_id][$categorie_id],
                'prix_p' => $this->prix_p[$tranche_id][$categorie_id],
            ]);
        });

        session()->flash('edit-price-message', 'Les prix sont modifiés pour - '. $this->nom_tranche[$tranche_id].' - ' . $this->nom_categorie[$categorie_id]);
        //return redirect()->to('/designation-prix');

    }

    // public function edit($ida, $produit_id, $tranche_id, $categorie_id, $categorie_nom, $produit_nom, $tranche_nom)
    // {

    //     DB::transaction(function () use ($ida, $produit_id, $categorie_id, $tranche_id) {
    //         Stock::where('id', $ida)->update([
    //             'prix_n' => $this->prix_n[$ida],
    //             'prix_f' => $this->prix_f[$ida],
    //             'prix_p' => $this->prix_p[$ida],
    //         ]);
    //         ProduitPrix::create([
    //             'produit_id' => $produit_id,
    //             'categorie_id' => $categorie_id,
    //             'tranche_id' => $tranche_id,
    //             'prix_n' => $this->prix_n[$ida],
    //             'prix_f' => $this->prix_f[$ida],
    //             'prix_p' => $this->prix_p[$ida],
    //         ]);
    //     });

    //     session()->flash('edit-price-message', 'Les prix sont modifiés pour ' . $produit_nom . " - " . $tranche_nom . " - " . $categorie_nom);
    //     //return redirect()->to('/designation-prix');

    // }

    public function render()
    {

        $items = Stock::query()
            ->where('produit_id', 'ilike', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->get()
            ->groupBy(['produit_id']);

        foreach ($items as $produit => $details) {
           $this->produit[$produit] = Produit::where('id',$produit)->first()->nom;
        }


        return view('livewire.vente.modification-prix', [
            'items' => $items,
        ]);
    }

}
