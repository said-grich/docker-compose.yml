<?php

namespace App\Http\Livewire\Vente;

use App\Models\BonLivraison as ModelBonLivraison;
use App\Models\BonLivraisonLigne;
use App\Models\Categorie;
use App\Models\Client;
use App\Models\Commande;
use App\Models\CommandeLigne;
use App\Models\Depot;
use App\Models\Livreur;
use App\Models\LotTranche;
use App\Models\ModeLivraison;
use App\Models\ModePaiement;
use App\Models\Produit;
use App\Models\Region;
use App\Models\StockKgPc;
use App\Models\StockPoidsPc;
use App\Models\TranchesKgPc;
use App\Models\TranchesPoidsPc;
use App\Models\Ville;
use App\Models\VilleQuartier;
use App\Models\VilleZone;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
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

    public $code = [];
    public $poids = [];
    public $isActive = false;

    public $list_mode_paiement = [];
    public $list_mode_livraison = [];
    public $list_region = [];
    public $list_livreurs = [];
    public $list_clients = [];
    public $list_qualites = [];
    public $list_produits = [];
    public $liste_poids_pc = [];
    public $liste_kg_pc = [];
    public $list_tranches = [];
    public $list_depots = [];
    public $list_categorie = [];

    public $countInputs;
    public $i = 0;

    public $qte = [];
    public $prix_vente = [];
    public $prix_achat = [];
    public $montant = [];

    public $date;
    public $ref_bl;
    public $ref_cmd;
    public $fournisseur;
    public $depot;
    public $qualite;
    public $montant_total;
    public $recherche_produit;
    public $recherche_poids;

    public $linenumber = -1;
    public $produitId = [];
    public $produitNom = [];
    public $nbr_piece = [];
    public $client;
    public $profile;
    public $categorie = [];
    public $prix =[];
    public $categorieId = [];
    public $depots = [];
    public $depotNom = [];
    public $depotId = [];

    public $totalMts = [];
    public $totalTtcs = [];
    public $totalTvas = [];
    public $totalMt;
    public $totalTtc;
    public $totalTva;

    //// commande
    public $mode_paiement;
    public $frais_livraison;
    public $date_livraison;
    public $ville;
    public $zone_ville;
    public $ville_quartie_id;
    public $adresse_livraison;
    public $tel_livraison;
    public $contact_livraison;
    public $livreur;
    public $ville_zone;
    public $mode_livraison_id;
    public $region_livraison;
    public $list_villes = [];
    public $list_ville_zones = [];
    public $list_quartiers = [];
    public $depot_livraison;


    public $filter = [
        "categorie" => "",
        "depot" => "",
        "recherche_produit" => "",
        "poids" => "",
    ];


    public $sortBy = 'ref';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function renderData()
    {
        $this->list_clients = Client::all()->sortBy('nom');
        $this->list_categorie = Categorie::all()->sortBy('nom');
        $this->list_mode_paiement = ModePaiement::all()->sortBy('nom');
        $this->list_livreurs = Livreur::all()->sortBy('nom');
        $this->list_mode_livraison = ModeLivraison::all()->sortBy('nom');
        $this->list_region = Region::all()->sortBy('nom');
    }

    function invoiceNumber()
    {
        $latest = ModelBonLivraison::latest()->first();

        if (! $latest) {
            return 'BL'.'0001';
        }

        $string = preg_replace("/[^0-9\.]/", '', $latest->ref);

        return 'BL'. sprintf('%04d', $string+1);
    }

    public function mount(){

        $latest_bl = ModelBonLivraison::latest()->first();
        if (! $latest_bl) {
            $this->ref_bl =  'BL'.'0001';
        }
        $string = preg_replace("/[^0-9\.]/", '', $latest_bl->ref);
        $this->ref_bl = 'BL'. sprintf('%04d', $string+1);

        $latest_cmd = Commande::latest()->first();
        if (! $latest_cmd) {
            return 'FLK'.'0001';
        }
        $string = preg_replace("/[^0-9\.]/", '', $latest_cmd->ref);

        $this->ref_cmd = 'FLK'. sprintf('%04d', $string+1);

        $this->date = date('d-m-Y');
    }

    public function updatedRegionLivraison($value){

        $this->list_villes = Ville::where('region_id', $value)->get();
        $this->list_depots = Depot::whereHas('ville', function (Builder $query) {
            $query->where('region_id', $this->region_livraison);
        })->get();
        $this->depots = $this->list_depots->pluck('id');

        $this->recherche_produit === '';
        $this->list_produits = [];

    }

    public function updatedVille($value){
        $this->list_ville_zones = VilleZone::where('ville_id', $value)->get();

    }

    public function updatedVilleZone($value){
        $this->list_quartiers = VilleQuartier::where('ville_zone_id', $value)->get();
    }

    public function updatedClient($value){
        $this->profile = Client::where('id', $value)->first()->profil->nom;
        //$this->updatedRechercheProduit();

    }

    public function loadList()
    {
        /* $collection = StockPoidsPc::all();
        $collection2 = StockKgPc::all(); */
        if ($this->filter['recherche_produit'] === '') {
            $this->list_produits = [];
            $this->nom_produit = [];
            $this->nom_tranche = [];
            $this->nbr_piece = [];
        } else if (!empty($this->filter['recherche_produit'])) {
            $collection = StockPoidsPc::where(function ($query) {
                $query->where(
                    function ($query) {
                        $query->select('nom')
                            ->from('produits')
                            ->whereColumn('produits.id', 'stock_poids_pcs.produit_id');
                    },
                    'ILIKE',
                    strtolower($this->filter['recherche_produit'] . '%')
                );
            })
                ->with('depot')
                ->with('produit')
                ->with('categorie')
                ->with('sousCategorie')
                ->with('unite')
                ->with('qualite')->get();


            $this->list_produits = $collection->groupBy(['produit_id', 'tranche_id']);
            foreach ($this->list_produits as $produit_id => $tranches) {
                //     //dd($this->list_produits);
                $this->nom_produit[$produit_id] = Produit::where('id', $produit_id)->first()->nom;
                foreach ($tranches as $tranche_uid => $produits) {

                    $this->nom_tranche[$produit_id][$tranche_uid] = isset(TranchesPoidsPc::where('uid', $tranche_uid)->first()->nom) ? TranchesPoidsPc::where('uid', $tranche_uid)->first()->nom : TranchesKgPc::where('uid', $tranche_uid)->first()->nom;
                    foreach ($produits as $key => $produit) {

                        switch ($this->profile) {
                            case "Normal":
                                $this->prix[$key] = $produit['prix_n'];
                                break;
                            case "Fidèle":
                                $this->prix[$key] = $produit['prix_f'];
                                break;
                            case "Business":
                                $this->prix[$key] = $produit['prix_p'];
                                break;
                        }
                    }
                    $nbr_pc = LotTranche::where('lot_num', $produits[0]->lot_num)->where('tranche_id', $tranche_uid)->first(['qte'])->qte;
                    $this->nbr_piece[$produit_id][$tranche_uid] = LotTranche::where('lot_num', $produits[0]->lot_num)->where('tranche_id', $tranche_uid)->first(['qte'])->qte;

                }
            }
                    }
            else {}
                }


     public function loadList1(){

        $query = [];

        if (!empty($this->filter["categorie"])) {
            $query["categorie_id"] = $this->filter["categorie"];
        }

        $poids_pc = StockPoidsPc::where($query);
        $kg_pc = StockKgPc::where($query);

        // Search
        if (!empty($this->filter["recherche_produit"])) {
            $filter = $this->filter;
            $poids_pc = $poids_pc->where(function ($query) use ($filter) {
                $query->where(
                    function ($query) {
                        $query->select('nom')
                            ->from('produits')
                            ->whereColumn('produits.id', 'stock_poids_pcs.produit_id');
                        //->limit(1);
                    },
                    'ILIKE',
                    strtolower($this->filter['recherche_produit'] . '%')

                )
                //->where('poids',$this->filter['poids'])
                ->with('depot')
                ->with('produit')
                ->with('categorie')
                ->with('sousCategorie')
                ->with('unite')
                ->with('qualite');

            });
        }

        if (!empty($this->filter["depot"])) {
            $order_type = (!empty($this->filter["depot"])) ? $this->filter["depot"] : 'ASC';
            $poids_pc = $poids_pc->where($this->filter["depot"], $order_type);
        }

        $poids_pc = $poids_pc->get();

        if (!empty($this->filter["recherche_produit"])) {
            $filter = $this->filter;
            $kg_pc = $kg_pc->where(function ($query) use ($filter) {
                $query->where(
                    function ($query) {
                        $query->select('nom')
                            ->from('produits')
                            ->whereColumn('produits.id', 'stock_kg_pcs.produit_id');
                        //->limit(1);
                    },
                    'ILIKE',
                    strtolower($this->filter['recherche_produit'] . '%')
                )
                ->with('depot')
                ->with('produit')
                ->with('categorie')
                ->with('sousCategorie')
                ->with('unite')
                ->with('qualite');
            });
        }

        if (!empty($this->filter["depot"])) {
            $order_type = (!empty($this->filter["depot"])) ? $this->filter["depot"] : 'ASC';
            $kg_pc = $kg_pc->where($this->filter["depot"], $order_type);
        }

        $kg_pc = $kg_pc->get();


        $collection = collect();
        foreach ($poids_pc as $poids_pc)
            $collection->push($poids_pc);
        foreach ($kg_pc as $kg_pc)
            $collection->push($kg_pc);
        $this->list_produits = $collection->groupBy(['produit_id', 'tranche_id']);

        foreach ($this->list_produits as $produit_id => $tranches) {
        //     //dd($this->list_produits);
            $this->nom_produit[$produit_id] = Produit::where('id', $produit_id)->first()->nom;
            foreach ($tranches as $tranche_uid => $produits) {

                $this->nom_tranche[$produit_id][$tranche_uid] = isset(TranchesPoidsPc::where('uid', $tranche_uid)->first()->nom) ? TranchesPoidsPc::where('uid', $tranche_uid)->first()->nom : TranchesKgPc::where('uid', $tranche_uid)->first()->nom;
                foreach ($produits as $key => $produit){

                    switch($this->profile) {
                        case "Normal":
                            $this->prix[$key] = $produit['prix_n'];
                            break;
                        case "Fidèle":
                            $this->prix[$key] = $produit['prix_f'];
                            break;
                        case "Business":
                            $this->prix[$key] = $produit['prix_p'];
                            break;
                    }
                }
                $nbr_pc = LotTranche::where('lot_num', $produits[0]->lot_num)->where('tranche_id', $tranche_uid)->first(['qte'])->qte;
                $this->nbr_piece[$produit_id][$tranche_uid] = LotTranche::where('lot_num', $produits[0]->lot_num)->where('tranche_id', $tranche_uid)->first(['qte'])->qte;


            }
        }

        //if ($this->recherche_produit === '') $this->list_produits = [];

     }

    public function updatedFilterCategorie(){
        $this->list_produits = [];
        $this->loadList();
    }

    public function updatedFilterRechercheProduit($value)
    {
        if (empty($value)) $this->list_produits = [];
        $this->loadList();

    }

    public function updatedFilterPoids()
    {
        $this->loadList();
    }



    public function save(){

        // $this->validate([
        //     'ref_bl' => 'required|unique:bon_livraisons,ref',
        //     'date' => 'required',
        //     'depot' => 'required',
        //     'client' => 'required',

        //     //'nbr_pc' => 'exclude_if:mode_vente_produit,1|required',
        // ]);

        DB::transaction(function () {

            $MAC = exec('getmac');
            $MAC = strtok($MAC, ' ');

            $commande = new Commande();
            $commande->ref = $this->ref_cmd;
            $commande->mac_address = $MAC;
            $commande->date = $this->date;
            //$commande->total = $this->totalMt;
            $commande->date_livraison = $this->date_livraison;
            $commande->tel_livraison = $this->tel_livraison;
            $commande->contact_livraison = $this->contact_livraison;
            $commande->adresse_livraison = $this->adresse_livraison;
            $commande->mode_livraison_id = $this->mode_livraison_id;
            $commande->frais_livraison = $this->frais_livraison;
            $commande->ville_quartie_id = $this->ville_quartie_id;
            $commande->mode_paiement_id = $this->mode_paiement;
            $commande->client_id = $this->client;
            $commande->livreur_id = $this->livreur;
            $commande->save();

            //foreach (array_unique ($this->depotId) as $key => $depot) {
                $bl = new ModelBonLivraison();
                $bl->ref = $this->ref_bl;
                $bl->date = $this->date;
                $bl->client_id = $this->client;
                $bl->depot_id = $this->depot_livraison;
                $bl->save();

                foreach ($this->produitNom as $key => $value) {

                    $bl_ligne = new BonLivraisonLigne();
                    $bl_ligne->bon_livraison_ref = $bl->ref;
                    $bl_ligne->produit_id = $this->produitId[$key];
                    $bl_ligne->categorie_id = $this->categorieId[$key];
                    $bl_ligne->code = isset($this->code[$key]) ? $this->code[$key] : '';
                    $bl_ligne->qte = $this->qte[$key];
                    $bl_ligne->prix= $this->prix_vente[$key];
                    $bl_ligne->montant= $this->montant[$key];
                    $bl_ligne->save();

                    CommandeLigne::create([
                        'commande_ref' => $commande->ref,
                        'produit_id' => $this->produitId[$key],
                        'categorie_id' => $this->categorieId[$key],
                        'qte' => $this->qte[$key],
                        'prix' => $this->prix_vente[$key],
                        'montant' => $this->montant[$key]
                    ]);

                }

                Livreur::where('id', $this->livreur)
                        ->update(['solde' => $this->totalMt]);

            //}

        });
        session()->flash('message', 'Bon de livraison réf "' . $this->ref_bl . '" a été crée');
        $this->reset(['code', 'list_produits','recherche_produit','depot','client']);

        //$this->emit('saved');

    }


    public function add($i,$productId, $qte, $prix, $tranche,$categorie)
    {
         //dd($i, $this->list_produits, $productId, $qte, $prix, $lot, $tranche, $code, $this->list_produits[$productId][$tranche][$i]);
         //dd($this->list_produits[$productId][$tranche][$i]['depot']['nom']);
        $this->linenumber++;

        $this->produitId[$this->linenumber] = $this->list_produits[$productId][$tranche][$i]['produit_id'];
        $this->produitNom[$this->linenumber] = Produit::where('id', $this->list_produits[$productId][$tranche][$i]['produit_id'])->first()->nom;
        $this->code[$this->linenumber] = isset($this->list_produits[$productId][$tranche][$i]['code']) ? $this->list_produits[$productId][$tranche][$i]['code'] : '';
        $this->poids[$this->linenumber] = isset($this->list_produits[$productId][$tranche][$i]['poids']) ?  $this->list_produits[$productId][$tranche][$i]['poids'] : '';
        $this->categorieId[$this->linenumber] = $categorie;

        $this->depotId[$this->linenumber] = $this->list_produits[$productId][$tranche][$i]['depot_id'];
        $this->depotNom[$this->linenumber] = $this->list_produits[$productId][$tranche][$i]['depot']['nom'];


        $this->qte[$this->linenumber] = $qte;
        $this->prix_vente[$this->linenumber] = $prix;
        //dd($this->produitNom);


        $this->updateData($this->linenumber);

        //$this->updatedRechercheProduit();
    }

    public function updateData($i)
    {
        if ($i == 0 && !isset($this->prix_vente[$i]) && !isset($this->poids[$i])) {
            $this->totalMt = 0;
            $this->totalTtc = 0;
            $this->totalTva = 0;

            $this->totalMts = [];
            $this->totalTtcs = [];
            $this->totalTvas = [];
        }


        if (isset($this->prix_vente[$i]) && isset($this->poids[$i])) {

            $qte = $this->poids[$i] == '' ? $this->qte[$i] : $this->poids[$i];

            array_splice($this->montant, $i, 1, $this->prix_vente[$i] > 0 ? $qte * $this->prix_vente[$i] : $qte * 0);

            $this->totalMts = [];

            $this->totalMt = 0;
            for ($i = 0; $i < count($this->montant); $i++) {
                $this->totalMt += $this->montant[$i];
            }

        }
    }

    public function render()
    {
        $this->renderData();
        //$this->loadList();

        $items = ModelBonLivraison::query()
            //->where('ref', $archived_lots_ids)
            ->where('ref', 'ilike', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
        //$list_produits  =  $this->list_produits;

        return view('livewire.vente.bon-livraison',compact(['items'/* , 'list_produits' */]));
    }
}
