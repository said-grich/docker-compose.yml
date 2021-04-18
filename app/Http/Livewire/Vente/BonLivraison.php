<?php

namespace App\Http\Livewire\Vente;

use App\Models\BonLivraison as ModelBonLivraison;
use App\Models\BonLivraisonLigne;
use App\Models\Categorie;
use App\Models\Client;
use App\Models\Commande;
use App\Models\CommandeLigne;
use App\Models\Depot;
use App\Models\Livraison;
use App\Models\Livreur;
use App\Models\LivreurCommande;
use App\Models\LotTranche;
use App\Models\ModeLivraison;
use App\Models\ModePaiement;
use App\Models\PreparationType;
use App\Models\Produit;
use App\Models\Region;
use App\Models\Stock;
use App\Models\StockKgPc;
use App\Models\StockPoidsPc;
use App\Models\Tranche;
use App\Models\TranchesKgPc;
use App\Models\TranchesPoidsPc;
use App\Models\Ville;
use App\Models\VilleQuartier;
use App\Models\VilleZone;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DateTime;
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
    public $pieceId = [];
    public $produitId = [];
    public $produitNom = [];
    public $pieceLot = [];
    public $pieceTranche = [];
    public $nbr_piece = [];
    public $client;
    public $profile;
    public $categorie = [];
    public $prix =[];
    public $categorieId = [];
    public $region_depots = [];
    public $depotNom = [];
    public $depotId = [];
    public $preparations_cuisine = [];
    public $preparations_nettoyage = [];

    public $totalMts = [];
    public $totalTtcs = [];
    public $totalTvas = [];
    public $totalMt;
    public $totalTtc;
    public $totalTva;
    public $bl_lignes = [];
    public $client_bl;

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
    public $seuil_livraison_gratuite;
    public $seuil_commande;
    public $commande_preparations = [];
    public $commande_preparation_cuisine = [];
    public $dates_livraison = [];
    public $heure_livraison;


    public $filter = [
        "categorie" => "",
        "depot" => "",
        "recherche_produit" => "",
        "poids" => 0.0,
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
        $this->list_mode_livraison = ModeLivraison::all()->sortBy('nom');
        $this->list_region = Region::all()->sortBy('nom');
    }

    /* function invoiceNumber()
    {
        $latest = ModelBonLivraison::latest()->first();

        if (! $latest) {
            return 'BL'.'0001';
        }
        $string = preg_replace("/[^0-9\.]/", '', $latest->ref);

        return 'BL'. sprintf('%04d', $string+1);
    } */

    public function mount(){

        //$sdate = Carbon::parse('this friday')->toDateString();
        // $jours = ['monday' =>'Lundi', 'tuesday' =>'Mardi', 'wednesday ' =>'Mercredi', 'thursday ' => 'Jeudi', 'friday ' =>'Vendredi', 'saturday ' =>'Samedi', 'sunday ' => 'Dimanche'];
        // $edate = Carbon::parse('this thursday');
        // $dates = [];

        // foreach ($jours as $key => $value) {
        //     $dates[$value] = Carbon::parse('this '. $key)->toDateString();
        // }
        // dd($edate->toDateString(),$jours, $dates);

        //dd(Carbon::now()->locale('fr_FR')->dayName );

        /* $count = 7;
        $dates = [];
        $dates_names = [];
        $date = Carbon::now()->locale('fr_FR');
        //$fr = CarbonImmutable::now()->locale('fr_FR');
        for ($i = 0; $i < $count; $i++) {
            $dates[] = $date->addDay()->format('d-m-Y');
            $dates_names[] = $date->addDay()->format('l');
        }

        // Show me what you got
        dd($date,$dates,$dates_names);


        $now = Carbon::now();
        $start = $now->startOfWeek(Carbon::MONDAY);
        $end = $now->endOfWeek(Carbon::SUNDAY);

        $fr = CarbonImmutable::now()->locale('fr_FR');

        dd($fr->firstWeekDay,$fr->lastWeekDay,$fr->startOfWeek()->format('Y-m-d H:i'),$fr->endOfWeek()->format('Y-m-d H:i'));
        dd($start,$end,$now); */

        $latest_bl = ModelBonLivraison::latest()->first();
        if (! $latest_bl) {
            $this->ref_bl =  'BL'.'0001';
        }else{
            $string = preg_replace("/[^0-9\.]/", '', $latest_bl->ref);
            $this->ref_bl = 'BL' . sprintf('%04d', $string + 1);

        }


        $latest_cmd = Commande::latest()->first();
        if (! $latest_cmd) {
            $this->ref_cmd  = 'FLK'.'0001';
        }else{
            $string = preg_replace("/[^0-9\.]/", '', $latest_cmd->ref);
            $this->ref_cmd = 'FLK' . sprintf('%04d', $string + 1);
        }

        $this->date = date('d-m-Y');
    }

    public function updatedRegionLivraison($value){

        $this->list_villes = Ville::where('region_id', $value)->get();
        $this->list_depots = Depot::whereHas('ville', function (Builder $query) {
            $query->where('region_id', $this->region_livraison);
        })->get();
        $this->region_depots = $this->list_depots->pluck('id');

        $this->recherche_produit === '';
        $this->list_produits = [];

    }

    public function updatedVille($value){

        $this->list_livreurs = Livreur::where('active',true)->where('ville_id',$value)->get()->sortBy('nom');
        $this->list_ville_zones = VilleZone::where('ville_id', $value)->get();
        $ville_livraison = Livraison::where('ville_id', $value)->first();
        $this->frais_livraison = isset($ville_livraison->frais_livraison) ? $ville_livraison->frais_livraison : '';
        $this->seuil_commande = isset(Livraison::where('ville_id', $value)->first()->seuil_commande) ? Livraison::where('ville_id', $value)->first()->seuil_commande : '';
        $this->seuil_livraison_gratuite = isset(Livraison::where('ville_id', $value)->first()->seuil_livraison_gratuite) ? Livraison::where('ville_id', $value)->first()->seuil_livraison_gratuite : '';
        $this->heure_livraison = isset(Livraison::where('ville_id', $value)->first()->heure) ? Livraison::where('ville_id', $value)->first()->heure : '';

        //dd(Carbon::now()->locale('fr_FR')->dayName );
        if($this->totalMt >= $this->seuil_livraison_gratuite){
            $this->frais_livraison = 0;
        }

        $jours_livraison = Livraison::where('ville_id', $value)->first()->jours_livraison;

        $jours = ['monday' => 'Lundi', 'tuesday' => 'Mardi', 'wednesday ' => 'Mercredi', 'thursday ' => 'Jeudi', 'friday ' => 'Vendredi', 'saturday ' => 'Samedi', 'sunday ' => 'Dimanche'];
        $dates = [];
        $dates_livraison = [];

        foreach ($jours as $key => $value) {
            $dates[$value] = Carbon::parse('this ' . $key)->toDateString();
        }

        foreach ($jours_livraison as $key => $value) {
            $dates_livraison[$value] = $dates[$value];
        }

        $this->dates_livraison =  $dates_livraison;

        //dd($jours_livraison,$this->dates_livraison,$dates_livraison);

    }

    public function updatedVilleZone($value){
        $this->list_quartiers = VilleQuartier::where('ville_zone_id', $value)->get();
    }

    public function updatedClient($value){
        $this->profile = Client::where('id', $value)->first()->profil->nom;
    }

    public function loadList()
    {

        /* if ($this->filter['recherche_produit'] === '') {
            $this->list_produits = [];
            $this->nom_produit = [];
            $this->nom_tranche = [];
            $this->nbr_piece = [];

        }else if(!empty($this->filter['recherche_produit'])){ */

            $collection = Stock::when($this->filter['recherche_produit'], function ($query) {
                $query->where(function ($q) {
                    $q->where(
                        function ($q) {
                            $q->select('nom')
                                ->from('produits')
                                ->whereColumn('produits.id', 'stocks.produit_id');
                        },
                        'ILIKE',
                        strtolower($this->filter['recherche_produit'] . '%')

                    );
                });
            })
                ->when($this->filter['categorie'], function ($query) {
                    $query->where('categorie_id', $this->filter['categorie']);
                })
                ->when($this->filter['depot'], function ($query) {
                    $query->where('depot_id', $this->filter['depot']);
                })
                ->when($this->filter['poids'], function ($query) {
                    $query->where('poids', $this->filter['poids']);
                })
                ->whereIn('depot_id', $this->region_depots)
                ->whereNotIn('id', $this->pieceId)
                ->where('qte_restante', '!=',0)

                ->with('depot')
                ->with('produit')
                ->with('categorie')
                ->with('sousCategorie')
                ->with('unite')
                ->with('qualite')
                ->get();

            $this->list_produits = $collection->groupBy(['produit_id', 'tranche_id'])->toArray();

            foreach ($this->list_produits as $produit_id => $tranches) {

                $this->nom_produit[$produit_id] = Produit::where('id', $produit_id)->first()->nom;
                foreach ($tranches as $tranche_uid => $produits) {

                    $this->nom_tranche[$produit_id][$tranche_uid] = Tranche::where('uid', $tranche_uid)->first()->nom;
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

                        $nbr_pc = LotTranche::where('lot_num', $produit['lot_num'])->where('tranche_id', $tranche_uid)->first(['qte'])->qte;
                        $this->nbr_piece[$produit_id][$tranche_uid] = $nbr_pc == 0 ?  $produit['qte_restante'] :  $nbr_pc;

                        if($produit['categorie_id'] == 2){

                            $this->preparations_cuisine[ $produit['id']] = PreparationType::where('produit_id',$produit['produit_id'])->whereHas('preparation', function (Builder $query) {
                                $query->where('preparations.mode_preparation_id', 1);
                            })->with('preparation')->get();

                            $this->preparations_nettoyage[ $produit['id']] = PreparationType::where('produit_id',$produit['produit_id'])->whereHas('preparation', function (Builder $query) {
                                $query->where('preparations.mode_preparation_id', 2);
                            })->with('preparation')->get();

                            //$this->preparations_nettoyage[ $produit['id']] = PreparationType::where('produit_id',$produit['produit_id'])->with('preparation')->get();
                        }

                    }

                }
            }
            //dd($this->preparations_cuisine,$this->preparations_nettoyage);

       /*  } */

    }

    public function updatedFilterCategorie(){
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

    public function updatedFilterDepot()
    {
        $this->loadList();
    }

    public function show($ref){
        $bon_livraison = ModelBonLivraison::where('ref',$ref)->first();
        $this->ref_bl =$ref;
        $this->date = $bon_livraison->date;
        $this->client_bl =$bon_livraison->client->nom;
        $this->depot =$bon_livraison->depot->nom;
        $this->bl_lignes = $bon_livraison->bonLivraisonLignes;
        $this->montant_total = $bon_livraison->geMontantTotal();
    }



    public function save(){

        $this->validate([
            'client' => 'required',
            'region_livraison' => 'required',
            'depot_livraison' => 'required',
            'tel_livraison' => 'required',
            'contact_livraison' => 'required',
            'adresse_livraison' => 'required',
            'ville' => 'required',
            'ville_zone' => 'required',
            'ville' => 'required',
            'ville_quartie_id' => 'required',
            'mode_paiement' => 'required',
            'mode_livraison_id' => 'required',
            'frais_livraison' => 'required',
            'date_livraison' => 'required',
            'livreur' => 'required',

        ]);

        if($this->totalMt >= $this->seuil_commande){
            DB::transaction(function () {

                $MAC = exec('getmac');
                $MAC = strtok($MAC, ' ');

                $commande = new Commande();
                $commande->ref = $this->ref_cmd;
                $commande->mac_address = $MAC;
                $commande->date = $this->date;
                $commande->etat = "Reçue";
                $commande->total = $this->totalMt + $this->frais_livraison;
                $commande->date_livraison = $this->date_livraison;
                $commande->heure_livraison = $this->heure_livraison;
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

                    foreach ($this->pieceId as $key => $value) {

                        $bl_ligne = new BonLivraisonLigne();
                        $bl_ligne->bon_livraison_ref = $bl->ref;
                        $bl_ligne->piece_id = $this->pieceId[$key];
                        $bl_ligne->categorie_id = $this->categorieId[$key];
                        $bl_ligne->code = isset($this->code[$key]) ? $this->code[$key] : '';
                        $bl_ligne->qte = $this->qte[$key];
                        $bl_ligne->prix= $this->prix_vente[$key];
                        $bl_ligne->montant= $this->montant[$key];
                        $bl_ligne->save();


                        CommandeLigne::create([
                            'commande_ref' => $commande->ref,
                            'piece_id' => $this->pieceId[$key],
                            'categorie_id' => $this->categorieId[$key],
                            'qte' => $this->qte[$key],
                            'prix' => $this->prix_vente[$key],
                            'montant' => $this->montant[$key],
                            'preparations' => isset($this->commande_preparations[$value]) ? $this->commande_preparations[$value] : [],
                            //'preparations' => isset($this->commande_preparation_nettoyage[$value]) ? $this->commande_preparation_nettoyage[$value] : '' ,
                        ]);


                        Stock::find($value)->update([
                            'qte_vendue' => DB::raw('qte_vendue +' .$this->qte[$key]),
                            'qte_restante' => DB::raw('qte_restante - ' .$this->qte[$key]),
                            ]);

                        $qte_tranche = LotTranche::where('lot_num', $this->pieceLot[$key])->where('tranche_id', $this->pieceTranche[$key])->first();

                        $qte_tranche->qte > 0 ? $qte_tranche->update(['qte' =>  DB::raw('qte - ' .$this->qte[$key])]) : '';

                        //->update(['qte' =>  DB::raw('qte - ' .$this->qte[$key])]);

                    }

                    $livreur = Livreur::find($this->livreur);
                    $livreur->solde = $livreur->solde + $commande->total;
                    $livreur->save();

                    LivreurCommande::create([
                        'livreur_id' => $livreur->id,
                        'commande_id' => $commande->id,
                    ]);

                    /* Livreur::where('id', $this->livreur)
                            ->update(['solde' => $this->totalMt]); */
                //}

            });

            session()->flash('message', 'Bon de livraison réf "' . $this->ref_bl . '" a été crée');
            $this->reset(['code', 'list_produits','recherche_produit','depot','client']);
        }else{
            session()->flash('error-commande', 'La commande doit déppaser le seuil de livraison : '.$this->seuil_commande);
        }

        //$this->emit('saved');

    }


    public function add($i,$productId, $qte, $prix, $tranche,$categorie,$pieceId)
    {
        $this->linenumber++;

        $this->pieceId[$this->linenumber] = $pieceId;

        $this->produitId[$this->linenumber] = $this->list_produits[$productId][$tranche][$i]['produit_id'];
        $this->pieceLot[$this->linenumber] = $this->list_produits[$productId][$tranche][$i]['lot_num'];
        $this->produitNom[$this->linenumber] = Produit::where('id', $this->list_produits[$productId][$tranche][$i]['produit_id'])->first()->nom;
        $this->code[$this->linenumber] = isset($this->list_produits[$productId][$tranche][$i]['code']) ? $this->list_produits[$productId][$tranche][$i]['code'] : '';
        $this->poids[$this->linenumber] = isset($this->list_produits[$productId][$tranche][$i]['poids']) ?  $this->list_produits[$productId][$tranche][$i]['poids'] : '';
        $this->categorieId[$this->linenumber] = $categorie;
        $this->pieceTranche[$this->linenumber] = $tranche;

        $this->depotId[$this->linenumber] = $this->list_produits[$productId][$tranche][$i]['depot_id'];
        $this->depotNom[$this->linenumber] = $this->list_produits[$productId][$tranche][$i]['depot']['nom'];

        $this->qte[$this->linenumber] = $qte;
        $this->prix_vente[$this->linenumber] = $prix;

        $this->updateData($this->linenumber);

        $this->loadList();
    }

    public function remove($i)
    {
        $this->linenumber--;

        array_splice($this->pieceId, $i, 1);
        array_splice($this->produitId, $i, 1);
        array_splice($this->pieceLot, $i, 1);
        array_splice($this->produitNom, $i, 1);
        array_splice($this->code, $i, 1);
        array_splice($this->poids, $i, 1);
        array_splice($this->categorieId, $i, 1);
        array_splice($this->pieceTranche, $i, 1);

        array_splice($this->depotId, $i, 1);
        array_splice($this->depotNom, $i, 1);

        array_splice($this->qte, $i, 1);
        array_splice($this->prix_vente, $i, 1);

        $this->updateData(0);
        $this->loadList();
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

        $items = ModelBonLivraison::query()
            ->where('ref', 'ilike', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.vente.bon-livraison',compact(['items']));
    }
}
