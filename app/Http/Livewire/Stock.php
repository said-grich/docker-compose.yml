<?php

namespace App\Http\Livewire;

use App\Models\BonReception;
use App\Models\BonReceptionLigne;
use App\Models\Categorie;
use App\Models\Depot;
use App\Models\Fournisseur;
use App\Models\Lot;
use App\Models\LotTranche;
use App\Models\ModeVente;
use App\Models\Produit;
use App\Models\ProduitTranche;
use App\Models\Qualite;
use App\Models\SousCategorie;
use App\Models\Stock as ModelsStock;
use App\Models\StockKgPc;
use App\Models\StockPoidsPc;
use App\Models\Tranche;
use App\Models\TranchesKgPc;
use App\Models\TranchesPoidsPc;
use App\Models\Unite;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Stock extends Component
{
    public $date_capture;
    public $date_entree;
    public $date_preemption;
    public $fournisseur;
    /* public $pas;
    public $qualite;
    public $produit; */
    public $active = false;
    public $showNbrPiece = false;

    public $lot_id;
    public $tranches = [];
    public $depot;
    /* public $prix_achat;
    public $qte; */
    public $cr;
    public $prix_vente_normal;
    public $prix_vente_fidele;
    public $prix_vente_business;
    public $active_stock =  false;

    public $list_fournisseurs = [];
    public $list_qualites = [];
    public $list_produits = [];
    public $list_lots = [];
    public $list_tranches = [];
    public $list_depots = [];
    public $list_unites = [];
    public $list_categories = [];
    public $list_sous_categories = [];
    public $stock_tranche = [];
    public $ref_br;
    public $date;
    public $lot_num = [];

    public $lot = [];

    public $pas = [];
    public $qualite = [];
    public $produit = [];
    public $categorie = [];
    public $sous_categorie = [];
    public $prix_achat = [];
    public $qte = [];
    public $nbr_pc = [];
    public $unite = [];
    public $mode_vente_produit = [];
    public $bon_recption_details;

    public $details = [];
    public $details_index;
    public $count_rows;
    public $nom_produit;
    public $code = [];
    public $poids = [];
    public $qualite_piece = [];
    public $code_poids = [];
    public $tranche_uid = [];
    public $nom_tranche = [];
    public $qualite_globale;

    public $inputs = [];
    public $i = 0;

    public $bon_reception_ref;
    public $article;
    public $produit_id = [];
    public $mode_vente_id;
    public $mode_vente;
    public $nombre_piece;
    public $liste_poids_pc = [];
    public $liste_kg_pc = [];

    public $article_kg_pc=[];
    public $produit_id_kg_pc=[];
    public $lot_num_kg_pc=[];
    public $pas_kg_pc=[];
    public $uid_tranche_kg_pc = [];
    public $nom_tranche_kg_pc = [];
    public $id_kg_pc = [];
    public $qualite_kg_pc=[];
    public $qte_kg_pc=[];
    public $unite_kg_pc=[];
    public $categorie_kg_pc=[];
    public $sous_categorie_kg_pc=[];
    public $prix_achat_kg_pc = [];

    public $sortBy = 'ref';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    protected $messages = [
        'ref_br.unique' => "Ref existe déja.",
        'lot_num.unique' => "Numéro de lot existe déja.",
        'lot_num.required' => "Le numéro de lot ne peut pas être vide.",
        'pas.required' => "Le pas ne peut pas être vide.",
    ];


    public function mount(){


        $latest_br = BonReception::latest()->first();
        if (! $latest_br) {
            $this->ref_br  = 'BR'.'0001';
        }else{
            $string = preg_replace("/[^0-9\.]/", '', $latest_br->ref);
            $this->ref_br = 'BR' . sprintf('%04d', $string + 1);
        }

    }

    public function add()
    {
        $this->i++;
        array_push($this->inputs, $this->i);
    }

    public function remove($i)
    {
        array_splice($this->inputs, $i - 1, 1);
        $this->i--;
    }

    public function updated(){
        $this->dispatchBrowserEvent('contentChanged');
    }

    public function renderData()
    {
        $this->list_fournisseurs = Fournisseur::all()->sortBy('nom');
        $this->list_qualites = Qualite::all()->sortBy('nom');
        $this->list_produits = Produit::all()->sortBy('nom');
        $this->list_lots = Lot::all()->sortBy('not_num');
        $this->list_depots = Depot::all()->sortBy('nom');
        $this->list_categories = Categorie::all()->sortBy('nom');
        $this->list_sous_categories = SousCategorie::all()->sortBy('nom');


    }
     public function updatedNbrPc($value,$index){
        $this->details[$index] = $value;
        //$this->poids = $index;
        //dump($this->details_index);
     }


     public function setCodePoids($i){
        //$this->reset(['code','poids']);

        $this->validate([
            'nbr_pc' => 'required',
        ]);

        $this->details_index = $i;
        $this->nom_produit =$this->produit[$i];
        $this->count_rows = $this->details[$i];
     }




    public function updatedProduit($value,$index){
        //$uniqueNumLot =  random_int(100, 999);
        //$fournisseur = Fournisseur::where('id',$this->fournisseur)->first(['nom'])->nom;

        $produit = Produit::where('id',$value)->first();
        $produit_tranches = ProduitTranche::where('produit_id', $value)->get();
        $this->mode_vente_produit[$index] = $produit->modeVente->id;
        $mode_vente = $produit->modeVente->id;
        $this->mode_vente_produit[$index] == 1 || $this->mode_vente_produit[$index] == 2 ? $this->unite[$index] =  Unite::where('nom', "Kg")->first()->nom : $this->unite[$index] =  Unite::where('nom', "Pièce")->first()->nom;
        //$this->lot_num[$index] = strtoupper(substr($fournisseur, 0, 3)) . strtoupper(substr($produit->nom, 0, 3)). $uniqueNumLot;

        foreach($produit_tranches as $key=>$value){
            //$kg_pc = TranchesKgPc::where('uid',$value->tranche_id)->first()->toArray();
            $this->list_tranches[$index][$key] =  Tranche::where('uid',$value->tranche_id)->get()->toArray();
        }
    }

    public function updatedLotNum($value,$index){

        if (ModelsStock::where('produit_id', $this->produit[$index])->where('lot_num', $value)->exists() ) {
            session()->flash('error-lot', 'Lot déja exist');
        }
        //dd($value,$index, $this->produit[$index]);
    }

    public function saveCodePoids(){
       // $produit = Produit::query()->get();
        $produit_tranche = ProduitTranche::with('produit')->get();
        foreach($produit_tranche as $val){
            $tranche = Tranche::where('uid',$val->tranche_id)->where('type',"Poids par pièce")->get();
        }
        // dd($produit_tranche);
        foreach ($this->code as $key => $value) {
            $code_poids[$value] = array( 'poids' =>$this->poids[$key], 'qualite' =>  $this->qualite_piece[$key]);
            $this->code_poids[$this->details_index] = $code_poids;
        }
     }
    public function createStock(){

        DB::transaction(function () {

            $item = new BonReception();
            $item->ref = $this->ref_br;
            $item->date = $this->date_entree;
            $item->depot_id = $this->depot;
            $item->qualite_id = $this->qualite_globale;
            $item->fournisseur_id = $this->fournisseur;
            $item->save();

            foreach ($this->produit as $key => $value) {
                $item = new Lot();
                $item->produit_id = $this->produit[$key];
                $item->lot_num = $this->lot_num[$key];
                $item->nombre_pieces = isset($this->nbr_pc[$key]) ? $this->nbr_pc[$key] : 0;
                $item->bon_reception_ref = $this->ref_br;
                $item->date_entree = $this->date_entree;
                $item->pas = $this->pas[$key];
                $item->fournisseur_id = $this->fournisseur;
                $item->qualite_id = $this->qualite[$key];
                $item->active = true;
                $item->save();

                if (BonReceptionLigne::where('bon_reception_ref', '=', $this->ref_br)
                    ->where('produit_id', '=', $this->produit[$key])
                    ->where('prix_achat', '=', $this->prix_achat[$key])
                    ->exists()
                ) {
                    $previous_row_qte = BonReceptionLigne::where('bon_reception_ref', '=', $this->ref_br)
                        ->where('produit_id', '=', $this->produit[$key])
                        ->where('prix_achat', '=', $this->prix_achat[$key])
                        ->first(['qte'])->qte;
                    BonReceptionLigne::where('bon_reception_ref', '=', $this->ref_br)
                        ->where('produit_id', $this->produit[$key])
                        ->where('prix_achat', $this->prix_achat[$key])
                        ->update(['qte' => $previous_row_qte + intval($this->qte[$key])]);
                } else {
                    $item = new BonReceptionLigne();
                    $item->bon_reception_ref = $this->ref_br;
                    $item->produit_id = $this->produit[$key];
                    $item->qte = $this->qte[$key];
                    $item->prix_achat = $this->prix_achat[$key];
                    $item->montant = $this->qte[$key] * $this->prix_achat[$key];
                    $item->save();
                }

                // foreach (array_reverse($this->produit) as $key => $value) {
                    $produit = Produit::where('id', $value)->first();
                    $lot_tranche = [];

                    if ($produit->modeVente->id == 1) {
                        foreach ($this->tranches[$key] as $k => $tranche) {
                            LotTranche::create([
                                'lot_num' => $this->lot_num[$key],
                                'tranche_id' => $tranche,
                            ]);

                            $lot_tranche[$key][$k] = Tranche::where('uid', $tranche)->get()->toArray()[0];
                        }

                        foreach ($this->code_poids[$key] as $code => $poids) {
                            foreach ($lot_tranche[$key] as $keyT => $valueT) {
                                if ($poids['poids'] >= $valueT['min_poids'] && $poids['poids'] < $valueT['max_poids']) {

                                    LotTranche::where('lot_num', $this->lot_num[$key])->where('tranche_id', $valueT['uid'])->update(['qte' => DB::raw('qte + 1')]);

                                    $item = new ModelsStock();
                                    $item->type = $produit->modeVente->nom;
                                    $item->qte = 1;
                                    $item->qte_restante = 1;
                                    $item->lot_num = $this->lot_num[$key];
                                    $item->produit_id = $this->produit[$key];
                                    $item->categorie_id = $this->categorie[$key];
                                    $item->sous_categorie_id = $this->sous_categorie[$key];
                                    $item->br_num = $this->ref_br;
                                    $item->depot_id = $this->depot;
                                    $item->prix_achat = $this->prix_achat[$key];
                                    $item->code = $code;
                                    $item->pas = $this->pas[$key];
                                    $item->unite_id = Unite::where('nom', $this->unite[$key])->first()->id;
                                    $item->poids = $poids['poids'];
                                    $item->qualite_id = $poids['qualite'];
                                    $item->tranche_id = $valueT['uid'];
                                    $item->cr = 0;
                                    $item->prix_n = 0;
                                    $item->prix_f = 0;
                                    $item->prix_p = 0;
                                    $item->qte_vendue = 0;
                                    $item->save();

                                }
                            }
                        }
                    }

                //}//end if mode vente poids par pièce

                else{
                    LotTranche::create([
                        'lot_num' => $this->lot_num[$key],
                        'tranche_id' => $this->tranches[$key],
                    ]);
                    $item = new ModelsStock();
                    $item->type = $produit->modeVente->nom;
                    $item->qte = $this->qte[$key];
                    $item->qte_restante = $this->qte[$key];
                    $item->lot_num = $this->lot_num[$key];
                    $item->produit_id = $this->produit[$key];
                    $item->categorie_id = $this->categorie[$key];
                    $item->sous_categorie_id = $this->sous_categorie[$key];
                    $item->br_num = $this->ref_br;
                    $item->depot_id = $this->depot;
                    $item->qualite_id = $this->qualite[$key];
                    $item->prix_achat = $this->prix_achat[$key];
                    $item->tranche_id = $this->tranches[$key];
                    $item->cr = 0;
                    $item->prix_n = 0;
                    $item->prix_f = 0;
                    $item->prix_p = 0;
                    $item->qte_vendue = 0;
                    $item->pas = $this->pas[$key];
                    $item->unite_id = Unite::where('nom', $this->unite[$key])->first()->id;
                    $item->save();
                }

            }

            session()->flash('message', 'Bon de réception réf "' . $this->ref_br . '" a été crée');
            $this->reset(['ref_br','lot_num', 'fournisseur', 'date_entree', 'qualite', 'pas', 'fournisseur', 'qualite', 'produit', 'active', 'qte', 'prix_achat', 'tranches','qualite_globale','depot','produit','categorie','sous_categorie','unite']);

            return redirect()->to('/entree-stock');

           // $this->emit('saved');
        });

    }


    public function createStockOld(){

        DB::transaction(function () {

            $item = new BonReception();
            $item->ref = $this->ref_br;
            $item->date = $this->date_entree;
            $item->depot_id = $this->depot;
            $item->qualite_id = $this->qualite_globale;
            $item->fournisseur_id = $this->fournisseur;
            $item->save();

            foreach ($this->produit as $key => $value) {
                $item = new Lot();
                $item->produit_id = $this->produit[$key];
                $item->lot_num = $this->lot_num[$key];
                $item->nombre_pieces = isset($this->nbr_pc[$key]) ? $this->nbr_pc[$key] : 0;
                $item->bon_reception_ref = $this->ref_br;
                $item->date_entree = $this->date_entree;
                $item->pas = $this->pas[$key];
                $item->fournisseur_id = $this->fournisseur;
                $item->qualite_id = $this->qualite[$key];
                $item->active = true;
                $item->save();

                if (BonReceptionLigne::where('bon_reception_ref', '=', $this->ref_br)
                    ->where('produit_id', '=', $this->produit[$key])
                    ->where('prix_achat', '=', $this->prix_achat[$key])
                    ->exists()
                ) {
                    $previous_row_qte = BonReceptionLigne::where('bon_reception_ref', '=', $this->ref_br)
                        ->where('produit_id', '=', $this->produit[$key])
                        ->where('prix_achat', '=', $this->prix_achat[$key])
                        ->first(['qte'])->qte;
                    BonReceptionLigne::where('bon_reception_ref', '=', $this->ref_br)
                        ->where('produit_id', $this->produit[$key])
                        ->where('prix_achat', $this->prix_achat[$key])
                        ->update(['qte' => $previous_row_qte + intval($this->qte[$key])]);
                } else {
                    $item = new BonReceptionLigne();
                    $item->bon_reception_ref = $this->ref_br;
                    $item->produit_id = $this->produit[$key];
                    $item->qte = $this->qte[$key];
                    $item->prix_achat = $this->prix_achat[$key];
                    $item->montant = $this->qte[$key] * $this->prix_achat[$key];
                    $item->save();
                }

                // foreach (array_reverse($this->produit) as $key => $value) {
                    $produit = Produit::where('id', $value)->first();
                    $lot_tranche = [];

                    if ($produit->modeVente->id == 1) {
                        foreach ($this->tranches[$key] as $k => $tranche) {
                            LotTranche::create([
                                'lot_num' => $this->lot_num[$key],
                                'tranche_id' => $tranche,
                            ]);

                            $lot_tranche[$key][$k] = TranchesPoidsPc::where('uid', $tranche)->get()->toArray()[0];
                        }


                    foreach ($this->code_poids[$key] as $code => $poids) {
                        foreach ($lot_tranche[$key] as $keyT => $valueT) {
                            if ($poids['poids'] >= $valueT['min_poids'] && $poids['poids'] < $valueT['max_poids']) {
                                LotTranche::where('lot_num', $this->lot_num[$key])->where('tranche_id', $valueT['uid'])->update(['qte' => DB::raw('qte + 1')]);

                                $item = new StockPoidsPc();
                                $item->qte = $this->qte[$key];
                                $item->lot_num = $this->lot_num[$key];
                                $item->produit_id = $this->produit[$key];
                                $item->categorie_id = $this->categorie[$key];
                                $item->sous_categorie_id = $this->sous_categorie[$key];
                                $item->br_num = $this->ref_br;
                                $item->depot_id = $this->depot;
                                $item->prix_achat = $this->prix_achat[$key];
                                $item->code = $code;
                                $item->pas = $this->pas[$key];
                                $item->unite_id = Unite::where('nom', $this->unite[$key])->first()->id;
                                $item->poids = $poids['poids'];
                                $item->qualite_id = $poids['qualite'];
                                $item->tranche_id = $valueT['uid'];
                                $item->cr = 0;
                                $item->prix_n = 0;
                                $item->prix_f = 0;
                                $item->prix_p = 0;
                                $item->save();

                            }
                        }
                    }

                }//end if mode vente poids par pièce

                else{
                    LotTranche::create([
                        'lot_num' => $this->lot_num[$key],
                        'tranche_id' => $this->tranches[$key],
                    ]);
                    $item = new StockKgPc();
                    $item->qte = $this->qte[$key];
                    $item->lot_num = $this->lot_num[$key];
                    $item->produit_id = $this->produit[$key];
                    $item->categorie_id = $this->categorie[$key];
                    $item->sous_categorie_id = $this->sous_categorie[$key];
                    $item->br_num = $this->ref_br;
                    $item->depot_id = $this->depot;
                    //$item->qualite_id = $this->qualite[$key];
                    $item->prix_achat = $this->prix_achat[$key];
                    $item->tranche_id = $this->tranches[$key];
                    $item->cr = 0;
                    $item->prix_n = 0;
                    $item->prix_f = 0;
                    $item->prix_p = 0;
                    $item->pas = $this->pas[$key];
                    $item->unite_id = Unite::where('nom', $this->unite[$key])->first()->id;
                    $item->save();
                }

            }
            session()->flash('message', 'Bon de réception réf "' . $this->ref_br . '" a été crée');
            //$this->reset(['lot_num', 'fournisseur', 'date_entree', 'qualite', 'pas', 'fournisseur', 'qualite', 'produit', 'active', 'qte', 'prix_achat', 'tranches']);

           // $this->emit('saved');
        });

    }


    /* public function updatedLotId($value){

        $lot = Lot::where('lot_num',$value)->first();
        $produit_tranches = ProduitTranche::where('produit_id', $lot->produit->id)->get();
        $mode_vente = $lot->produit->mode_vente_id;

        foreach($produit_tranches as $key=>$value){
            $this->list_tranches[$key] = $mode_vente == 1 ? TranchesPoidsPc::where('uid',$value->tranche_id)->get()->toArray() : TranchesKgPc::where('uid',$value->tranche_id)->get()->toArray();
        }

    } */


    public function createLots(){
        $this->validate([
            'ref_br' => 'required|unique:bon_receptions,ref',
            'lot_num' => 'required|unique:lots,lot_num',
            'date_entree' => 'required',
            'pas' => 'required',
            'qualite' => 'required',
            'produit' => 'required',
            'fournisseur' => 'required',
            'qte' => 'required',
            'prix_achat' => 'required',
            'unite' => 'required',
            'tranches' => 'required',
            //'nbr_pc' => 'exclude_if:mode_vente_produit,1|required',
        ]);

        DB::transaction(function () {

            $item = new BonReception();
            $item->ref = $this->ref_br;
            $item->valide = false;
            $item->date = $this->date_entree;
            $item->depot_id = $this->depot;
            $item->fournisseur_id = $this->fournisseur;
            $item->save();


            foreach ($this->produit as $key => $value) {
                $item = new Lot();
                $item->produit_id = $this->produit[$key];
                $item->lot_num = $this->lot_num[$key];
                $item->nombre_pieces = isset($this->nbr_pc[$key]) ? $this->nbr_pc[$key] : 0;
                $item->bon_reception_ref = $this->ref_br;
                $item->date_entree = $this->date_entree;
                $item->pas = $this->pas[$key];
                $item->fournisseur_id = $this->fournisseur;
                $item->qualite_id = $this->qualite[$key];
                $item->active = true;
                $item->save();


                if (BonReceptionLigne::where('bon_reception_ref', '=', $this->ref_br)
                ->where('produit_id', '=', $this->produit[$key])
                ->where('prix_achat', '=', $this->prix_achat[$key])
                ->exists()) {
                    $previous_row_qte = BonReceptionLigne::where('bon_reception_ref', '=', $this->ref_br)
                        ->where('produit_id', '=', $this->produit[$key])
                        ->where('prix_achat', '=', $this->prix_achat[$key])
                        ->first(['qte'])->qte;
                    BonReceptionLigne::where('bon_reception_ref', '=', $this->ref_br)
                        ->where('produit_id', $this->produit[$key])
                        ->where('prix_achat', $this->prix_achat[$key])
                        ->update(['qte' => $previous_row_qte + intval($this->qte[$key]) ]);
                }else{
                    $item = new BonReceptionLigne();
                    $item->bon_reception_ref = $this->ref_br;
                    $item->produit_id = $this->produit[$key];
                    $item->qte = $this->qte[$key];
                    $item->prix_achat = $this->prix_achat[$key];
                    $item->montant = $this->qte[$key] * $this->prix_achat[$key];
                    $item->save();
                }

                foreach ($this->tranches[$key] as $ke => $value) {
                    LotTranche::create([
                        'lot_num' => $this->lot_num[$key],
                        'tranche_id' => $value,
                    ]);
                }

                //$this->bon_recption_details = $item;

            }
            session()->flash('message', 'Bon de réception réf "' . $this->ref_br . '" a été crée');
            $this->reset(['lot_num','fournisseur','date_entree','qualite','pas','fournisseur','qualite','produit','active','qte','prix_achat','tranches']);

            $this->emit('saved');

        });
    }


    public function createLot(){

        //$this->validate();

        $this->validate([
            'pas' => 'required',
            'fournisseur' => 'required',
            'produit' => 'required',
            'lot_num' => 'required',
            'date_capture' => 'required',
            'date_entree' => 'required',
            'date_preemption' => 'required',
            'qualite' => 'required',
        ]);

        DB::transaction(function () {

            $item = new Lot();
            $item->lot_num = $this->lot_num;
            $item->date_capture = $this->date_capture;
            $item->date_entree = $this->date_entree;
            $item->date_preemption = $this->date_preemption;
            $item->pas = $this->pas;
            $item->fournisseur_id = $this->fournisseur;
            $item->qualite_id = $this->qualite;
            $item->produit_id = $this->produit;
            $item->active = $this->active;

            $item->save();

            foreach ($this->tranches as $key => $value) {
                LotTranche::create([
                    'lot_num' => $this->lot_num,
                    'tranche_id' =>$this->tranches[$key],
                ]);
            }
        });

        session()->flash('message', 'Lot numéro "' . $this->lot_num . '" a été crée');
        $this->reset(['lot_num','date_capture','date_entree','date_preemption','pas','fournisseur','qualite','produit','active']);

        $this->emit('saved');
    }

    public function show($id){

        $this->liste_poids_pc = ModelsStock::where('br_num',$id)->where('type',"Poids par pièce")->get();
        $this->liste_kg_pc = ModelsStock::where('br_num',$id)->where('type', '!=',"Poids par pièce")->get();

        $this->bon_reception_ref =$id;


        foreach ($this->liste_poids_pc as $key => $value) {
            $this->lot_num[$key] =$value->lot_num;
            $this->produit_id[$key]  =$value->lot->produit->id;
            $this->article[$key]  =$value->lot->produit->nom;
            $this->nom_tranche[$key] = Tranche::where('uid', $value->tranche_id)->first()->nom;
            $this->categorie[$key]  =$value->categorie->nom;
            $this->sous_categorie[$key]  =$value->sousCategorie->nom;
            $this->poids[$key] = $value->poids;
            $this->code[$key] = $value->code;
            $this->qualite[$key]  =$value->qualite->nom;
            $this->qte[$key]  =$value->qte;
            $this->prix_achat[$key]  =$value->prix_achat;
            $this->pas[$key]  =$value->pas;
            $this->unite[$key]  = $value->unite->nom;
        }

        foreach ($this->liste_kg_pc as $k => $v) {
            $this->id_kg_pc[$k] = $v->id;
            $this->lot_num_kg_pc[$k] =$v->lot_num;
            $this->produit_id_kg_pc[$k]  =$v->lot->produit->id;
            $this->article_kg_pc[$k]  =$v->lot->produit->nom;
            $this->nom_tranche_kg_pc[$k] = Tranche::where('uid', $v->tranche_id)->first()->nom;
            $this->uid_tranche_kg_pc[$k] = Tranche::where('uid', $v->tranche_id)->first()->uid;
            $this->prix_achat_kg_pc[$k] = $v->prix_achat;
            $this->categorie_kg_pc[$k] = $v->categorie->nom;
            $this->sous_categorie_kg_pc[$k] = $v->sousCategorie->nom;
            $this->qualite_kg_pc[$k] = $v->lot->qualite->nom;
            $this->unite_kg_pc[$k]  = $v->unite->nom;
            $this->qte_kg_pc[$k] = $v->qte;
            $this->pas_kg_pc[$k] = $v->pas;

        }





        /* groupement par tranches
        foreach ($this->liste_poids_pc as $key => $value) {
            $this->nom_tranche[$key] = TranchesPoidsPc::where('uid', $key)->first()->nom;

            foreach ($value as $produit => $details){
                $this->article[$key] = Produit::where('id', $produit)->first()->nom;
                foreach ($details as $k => $v){
                    $this->lot_num[$key] =$v->lot_num;
                    $this->article[$key]  =$v->lot->produit->nom;
                    $this->categorie[$key]  =$v->categorie->nom;
                    $this->sous_categorie[$key]  =$v->sousCategorie->nom;
                    $this->qte[$key]  =$v->qte;
                    $this->prix_achat[$key]  =$v->prix_achat;
                    $this->qualite[$key]  =$v->qualite->nom;
                    $this->pas[$key]  =$v->pas;
                    $this->code[$key] = $v->code;

                }
            }

        } */
        //dd($this->article);

        foreach ($this->liste_kg_pc as $k => $v) {
           /*  $this->id_kg_pc[$k] = $v->id;
            $this->lot_num_kg_pc[$k] =$v->lot_num;
            $this->produit_id_kg_pc[$k]  =$v->lot->produit->id;
            $this->article_kg_pc[$k]  =$v->lot->produit->nom;
            $this->nom_tranche_kg_pc[$k] = TranchesKgPc::where('uid', $v->tranche_id)->first()->nom;
            $this->uid_tranche_kg_pc[$k] = TranchesKgPc::where('uid', $v->tranche_id)->first()->uid; */
        }
    }

public $list =[];
public $list_piece = [];
    public function edit($id){

        $this->liste_poids_pc = ModelsStock::where('br_num',$id)->where('type',"Poids par pièce")->get();
        $this->liste_kg_pc = ModelsStock::where('br_num',$id)->where('type', '!=',"Poids par pièce")->get();

        $this->bon_reception_ref =$id;

        foreach ($this->liste_poids_pc as $key => $value) {
            $this->lot_num[$key] =$value->lot_num;
            $this->produit_id[$key]  =$value->produit->id;
            $this->article[$key]  =$value->produit->id;
            $this->list_piece = ProduitTranche::where('produit_id',$this->produit_id[$key])->join('tranches','tranches.uid','=','produit_tranches.tranche_id')->get('tranches.*');
            $this->uid_tranche[$key] = $value->tranche_id;
            $this->categorie[$key]  =$value->categorie->id;
            $this->sous_categorie[$key]  =$value->sousCategorie->id;
            $this->poids[$key] = $value->poids;
            $this->code[$key] = $value->code;
            $this->qualite[$key]  =$value->qualite->id;
            $this->qte[$key]  =$value->qte;
            $this->prix_achat[$key]  =$value->prix_achat;
            $this->pas[$key]  =$value->pas;
            $this->unite[$key]  = $value->unite->nom;
        }

        foreach ($this->liste_kg_pc as $k => $v) {
            $this->id_kg_pc[$k] = $v->id;
            $this->lot_num_kg_pc[$k] =$v->lot_num;
            $this->produit_id_kg_pc[$k]  =$v->produit->id;
            $this->article_kg_pc[$k]  =$v->produit->id;
            $this->list = ProduitTranche::where('produit_id', $this->produit_id_kg_pc[$k])->join('tranches','tranches.uid','=','produit_tranches.tranche_id')->get('tranches.*');
            $this->uid_tranche_kg_pc[$k] = $v->tranche_id;
            $this->prix_achat_kg_pc[$k] = $v->prix_achat;
            $this->categorie_kg_pc[$k] = $v->categorie->id;
            $this->sous_categorie_kg_pc[$k] = $v->sousCategorie->id;
            $this->qualite_kg_pc[$k] = $v->qualite->id;
            $this->qte_kg_pc[$k] = $v->qte;
            $this->pas_kg_pc[$k] = $v->pas;
            $this->unite_kg_pc[$k]  = $v->unite->nom;

        }


    }
    public $uid_tranche;
    public function editStock(){
        foreach ($this->liste_kg_pc as $key => $value) {
            ModelsStock::where('br_num',$this->bon_reception_ref)->update([

                'produit_id'=> $this->article_kg_pc[$key],
                'categorie_id' => $this->categorie_kg_pc[$key],
                'sous_categorie_id'=>  $this->sous_categorie_kg_pc[$key],
                'tranche_id'=>  $this->uid_tranche_kg_pc[$key],
                'qualite_id' => $this->qualite_kg_pc[$key],
                'lot_num'=> $this->lot_num_kg_pc[$key],
                'prix_achat' => $this->prix_achat_kg_pc[$key],
                'qte' => $this->qte_kg_pc[$key],
                'pas'=>$this->pas_kg_pc[$key],

            ]);

        }
        foreach ($this->liste_poids_pc as $key => $value) {
            ModelsStock::where('br_num',$this->bon_reception_ref)->update([

                'produit_id'=> $this->article[$key],
                'categorie_id' => $this->categorie[$key],
                'sous_categorie_id'=> $this->sous_categorie[$key],
                'tranche_id'=> $this->uid_tranche[$key],
                'qualite_id' => $this->qualite[$key] ,
                //'unite_id' => $this->unite[$key],
                'lot_num'=> $this->lot_num[$key],
                'prix_achat' =>  $this->prix_achat[$key],
                'qte' => $this->qte[$key],
                'pas'=> $this->pas[$key],

            ]);
        }

    }
    public function delete($id){

        $this->render();

        $recep = BonReception::findOrFail($id);
        $bon_recep = BonReception::where('ref',$recep->ref)->get();
        foreach($bon_recep as $r){
            DB::table('bon_reception_lignes')->where('bon_reception_ref', $r->bon_reception_ref)->delete();
            DB::table('stocks')->where('br_num', $r->br_num)->delete();
            DB::table('lots')->where('bon_reception_ref', $r->bon_reception_ref)->delete();
        }

        BonReception::where('ref',$recep ->ref)->delete();
    }
    public function supp($id){

        $stock = ModelsStock::findOrFail($id);
        DB::table('stocks')->where('id', $id)->delete();
        $stock->delete();
    }
    /*public function edit($id){
        /* $this->liste_poids_pc = collect(StockPoidsPc::where('br_num',$id)->get()->groupBy(['tranche_id','produit_id']));
        $this->liste_kg_pc = StockKgPc::where('br_num',$id)->get();
        $this->bon_reception_ref =$id; */

        /*$this->liste_poids_pc = StockPoidsPc::where('br_num',$id)->get();
        $this->liste_kg_pc = StockKgPc::where('br_num',$id)->get();
        $this->bon_reception_ref =$id;


        foreach ($this->liste_poids_pc as $key => $value) {
            $this->lot_num[$key] =$value->lot_num;
            $this->produit_id[$key]  =$value->lot->produit->id;
            $this->article[$key]  =$value->lot->produit->nom;
            $this->nom_tranche[$key] = TranchesPoidsPc::where('uid', $value->tranche_id)->first()->nom;
            $this->categorie[$key]  =$value->categorie->nom;
            $this->sous_categorie[$key]  =$value->sousCategorie->nom;
            $this->poids[$key] = $value->poids;
            $this->code[$key] = $value->code;
            $this->qualite[$key]  =$value->qualite->nom;
            $this->qte[$key]  =$value->qte;
            $this->prix_achat[$key]  =$value->prix_achat;
            $this->pas[$key]  =$value->pas;
            $this->unite[$key]  = $value->unite->nom;
        }

        foreach ($this->liste_kg_pc as $k => $v) {
            $this->id_kg_pc[$k] = $v->id;
            $this->lot_num_kg_pc[$k] =$v->lot_num;
            $this->produit_id_kg_pc[$k]  =$v->lot->produit->id;
            $this->article_kg_pc[$k]  =$v->lot->produit->nom;
            $this->nom_tranche_kg_pc[$k] = TranchesKgPc::where('uid', $v->tranche_id)->first()->nom;
            $this->uid_tranche_kg_pc[$k] = TranchesKgPc::where('uid', $v->tranche_id)->first()->uid;
            $this->prix_achat_kg_pc[$k] = $v->prix_achat;
            $this->categorie_kg_pc[$k] = $v->categorie->nom;
            $this->sous_categorie_kg_pc[$k] = $v->sousCategorie->nom;
            $this->qualite_kg_pc[$k] = $v->lot->qualite->nom;
            $this->qte_kg_pc[$k] = $v->qte;
            $this->pas_kg_pc[$k] = $v->pas;
            $this->unite[$key]  = $value->unite->nom;

        }



        /* groupement par tranches
        foreach ($this->liste_poids_pc as $key => $value) {
            $this->nom_tranche[$key] = TranchesPoidsPc::where('uid', $key)->first()->nom;

            foreach ($value as $produit => $details){
                $this->article[$key] = Produit::where('id', $produit)->first()->nom;
                foreach ($details as $k => $v){
                    $this->lot_num[$key] =$v->lot_num;
                    $this->article[$key]  =$v->lot->produit->nom;
                    $this->categorie[$key]  =$v->categorie->nom;
                    $this->sous_categorie[$key]  =$v->sousCategorie->nom;
                    $this->qte[$key]  =$v->qte;
                    $this->prix_achat[$key]  =$v->prix_achat;
                    $this->qualite[$key]  =$v->qualite->nom;
                    $this->pas[$key]  =$v->pas;
                    $this->code[$key] = $v->code;

                }
            }

        } */
        //dd($this->article);

       /* foreach ($this->liste_kg_pc as $k => $v) {
           /*  $this->id_kg_pc[$k] = $v->id;
            $this->lot_num_kg_pc[$k] =$v->lot_num;
            $this->produit_id_kg_pc[$k]  =$v->lot->produit->id;
            $this->article_kg_pc[$k]  =$v->lot->produit->nom;
            $this->nom_tranche_kg_pc[$k] = TranchesKgPc::where('uid', $v->tranche_id)->first()->nom;
            $this->uid_tranche_kg_pc[$k] = TranchesKgPc::where('uid', $v->tranche_id)->first()->uid; */
       /* }
   // }*/

    public function render()
    {
        $this->renderData();
        $items = BonReception::query()
            ->where('ref','ilike','%'.$this->search.'%')
            //->where('valide',true)
            ->orderBy($this->sortBy, $this->sortDirection)
           // ->get();
            ->paginate($this->perPage);
            //dd($items)

        return view('livewire.stock', compact(['items']));
    }
}
