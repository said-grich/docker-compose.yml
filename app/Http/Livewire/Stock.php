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
use App\Models\StockKgPc;
use App\Models\StockPoidsPc;
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

    public $ref_br;
    public $date;
    public $pas = [];
    public $qualite = [];
    public $produit = [];
    public $categorie = [];
    public $sous_categorie = [];
    public $prix_achat = [];
    public $qte = [];
    public $nbr_pc = [];
    public $lot_num = [];
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

    protected $messages = [
        'ref_br.unique' => "Ref existe déja.",
        'lot_num.unique' => "Numéro de lot existe déja.",
        'lot_num.required' => "Le numéro de lot ne peut pas être vide.",
        'pas.required' => "Le pas ne peut pas être vide.",
    ];

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

    public function updatedFournisseur($value){
        $uniqueNumLot =  random_int(100, 999);
        $fournisseur = Fournisseur::where('id',$value)->first(['nom']);
        $fournisseur_nom = substr($fournisseur->nom, 0, 3);
        $this->lot_num = $fournisseur_nom.$uniqueNumLot;
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
        $this->details_index = $i;
        $this->nom_produit =$this->produit[$i];
        $this->count_rows = $this->details[$i];
     }

     public function saveCodePoids(){
        foreach ($this->code as $key => $value) {
            $code_poids[$value] = array( 'poids' =>$this->poids[$key], 'qualite' =>  $this->qualite_piece[$key]);
            $this->code_poids[$this->details_index] = $code_poids;
        }
     }


    public function updatedProduit($value,$index){

        $produit = Produit::where('id',$value)->first();
        $produit_tranches = ProduitTranche::where('produit_id', $value)->get();
        $this->mode_vente_produit[$index] = $produit->modeVente->id;
        $mode_vente = $produit->modeVente->id;
        $this->mode_vente_produit[$index] == 1 ? $this->unite[$index] =  Unite::where('nom', "Kg")->first()->nom : $this->unite[$index] =  Unite::where('nom', "Pièce")->first()->nom;

        foreach($produit_tranches as $key=>$value){
            //$kg_pc = TranchesKgPc::where('uid',$value->tranche_id)->first()->toArray();
            //dd( $kg_pc);

            if($this->mode_vente_produit[$index] == 1 ){
                $this->list_tranches[$index][$key] =  TranchesPoidsPc::where('uid',$value->tranche_id)->get()->toArray();
            }else{
                $this->list_tranches[$index][$key] = TranchesKgPc::where('uid',$value->tranche_id)->get()->toArray();
            }

        }

        //$this->list_tranches[];
        //$this->mode_vente_produit[$index] == 1 ? $this->showNbrPiece = true : $this->showNbrPiece = false;
        //unset($this->list_tranches);

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

                            $lot_tranche[$key][$k] = TranchesPoidsPc::where('uid', $tranche)->get()->toArray()[0];
                        }

                    foreach ($this->code_poids[$key] as $code => $poids) {
                        foreach ($lot_tranche[$key] as $keyT => $valueT) {
                            if ($poids['poids'] >= $valueT['min_poids'] && $poids['poids'] < $valueT['max_poids']) {
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
                    $item->save();
                }

            }
            session()->flash('message', 'Bon de réception réf "' . $this->ref_br . '" a été crée');
            //$this->reset(['lot_num', 'fournisseur', 'date_entree', 'qualite', 'pas', 'fournisseur', 'qualite', 'produit', 'active', 'qte', 'prix_achat', 'tranches']);

            $this->emit('saved');
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

    public function render()
    {
        $this->renderData();
        return view('livewire.stock');
    }
}
