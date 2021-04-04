<?php

namespace App\Http\Livewire\Vente;

use App\Models\BonLivraison as ModelBonLivraison;
use App\Models\Client;
use App\Models\Depot;
use App\Models\Produit;
use App\Models\StockPoidsPc;
use App\Models\TranchesPoidsPc;
use Livewire\Component;
use Livewire\WithPagination;

class BonLivraison extends Component
{

    use WithPagination;
    public $tranche_id = [];

    public $lot_id;
    public $lot_num;
    public $article;
    public $nom_produit = [];
    public $mode_vente_id;
    public $mode_vente;
    public $nombre_piece;
    public $nom_tranche = [];
    public $produits_selected = [];
    // public $tranche_id = [];
    public $code = [];
    public $poids = [];
    public $isActive = false;

    public $list_clients = [];
    public $list_qualites = [];
    public $list_produits = [];
    public $liste_poids_pc = [];
    public $liste_kg_pc = [];
    public $list_tranches = [];
    public $list_depots = [];
    public $showNbrPiece = false;

    public $countInputs;
    public $i = 0;

    public $qte = [];
    public $prix_vente = [];
    public $prix_achat = [];
    public $montant = [];

    public $date;
    public $ref_br;
    public $fournisseur;
    public $depot;
    public $qualite;
    public $montant_total;
    public $recherche_produit;

    public $linenumber = -1;
    public $produitId = [];
    public $produitNom = [];
    public $client;



    public $sortBy = 'ref';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function renderData()
    {
        $this->list_clients = Client::all()->sortBy('nom');
        $this->list_depots = Depot::all()->sortBy('nom');
    }

    public function updatedRechercheProduit(){

        $this->list_produits = StockPoidsPc::where('depot_id', $this->depot)
            ->where(function ($query) {
                $query->where(
                    function ($query) {
                        $query->select('nom')
                            ->from('produits')
                            ->whereColumn('produits.id', 'stock_poids_pcs.produit_id');
                            //->limit(1);
                    },
                    'ILIKE',
                    strtolower($this->recherche_produit . '%')
                );
            })
            ->with('depot')
            ->with('produit')
            ->get()
            ->groupBy(['produit_id','tranche_id']);

            foreach ($this->list_produits as $produit_id => $tranches) {
                $this->nom_produit[$produit_id] = Produit::where('id', $produit_id)->first()->nom;
                foreach ($tranches as $tranche_uid => $produits) {
                    $this->nom_tranche[$produit_id][$tranche_uid] = TranchesPoidsPc::where('uid', $tranche_uid)->first()->nom;

                }
            }

        if ($this->recherche_produit === '') $this->list_produits = [];
        //dd($this->nom_produit, $this->nom_tranche, $produits);

    }

    public function add($i,$productId, $qte, $prix, $lot,$code, $tranche)
    {
         //dd($i, $this->list_produits, $productId, $qte, $prix, $lot, $tranche, $code, $this->list_produits[$productId][$tranche][$i]);
        $this->linenumber++;

        $this->produitId[$this->linenumber] = $this->list_produits[$productId][$tranche][$i]['produit_id'];
        $this->produitNom[$this->linenumber] = Produit::where('id', $this->list_produits[$productId][$tranche][$i]['produit_id'])->first()->nom;
        $this->code[$this->linenumber] = $this->list_produits[$productId][$tranche][$i]['code'];
        $this->poids[$this->linenumber] = $this->list_produits[$productId][$tranche][$i]['poids'];

        $this->qte[$this->linenumber] = $qte;
        $this->prix_vente[$this->linenumber] = $prix;
        //dd($this->produitNom);





        // $this->updateData($this->linenumber);

        $this->updatedRechercheProduit();
    }

    public function render()
    {
        $this->renderData();

        $items = ModelBonLivraison::query()
            //->where('ref', $archived_lots_ids)
            ->where('ref', 'ilike', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.vente.bon-livraison',compact(['items']));
    }
}
