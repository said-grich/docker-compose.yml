<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\BonReception;
use App\Models\Livreur;
use App\Models\Lot;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Depot;
use App\Models\LotTranche;
use App\Models\Qualite;
use App\Models\StockKgPc;
use App\Models\StockPoidsPc;
use App\Models\TranchesKgPc;
use App\Models\TranchesPoidsPc;
use Livewire\Component;
use Livewire\WithPagination;

class ListeLots extends Component
{
    use WithPagination;
    public $tranche_id = [];

    public $lot_id;
    public $lot_num;
    public $article;
    public $mode_vente_id;
    public $mode_vente;
    public $nombre_piece;
    public $nom_tranche = [];
    public $test = [];
   // public $tranche_id = [];
    public $code;
    public $poids;
    public $isActive = false;

    public $list_fournisseurs = [];
    public $list_qualites = [];
    public $list_produits = [];
    public $list_lots = [];
    public $list_tranches = [];
    public $list_depots = [];
    public $showNbrPiece = false;

    public $countInputs;
    public $i = 0;

    public $qte = [];
    public $cr = [];
    public $depot = [];
    public $prix_achat = [];
    public $prix_vente_normal = [];
    public $prix_vente_fidele = [];
    public $prix_vente_business = [];
    public $bon_reception = [];
    public $liste_lots= [];
    public $bon_reception_ref;


    public $sortBy = 'ref';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function updatedNombrePiece($value){

        $this->countInputs = $value;

    }

    public function renderData()
    {
        $this->list_fournisseurs = Fournisseur::all()->sortBy('nom');
        $this->list_qualites = Qualite::all()->sortBy('nom');
        $this->list_produits = Produit::all()->sortBy('nom');
        $this->list_lots = Lot::all()->sortBy('not_num');
        $this->list_depots = Depot::all()->sortBy('nom');

    }

    public function render()
    {
        $this->renderData();
        $lot_stock_kg_pc = array_unique(StockKgPc::pluck('lot_num')->toArray());
        $lot_stock_poids_pc = array_unique(StockPoidsPc::pluck('lot_num')->toArray());
        $archived_lots_ids = array_merge($lot_stock_kg_pc, $lot_stock_poids_pc);

        // $in_progress_lots_ids = array_unique(Lot::whereNotIn('lot_num', $archived_lots_ids)->pluck('lot_num')->toArray());

        /* $items = Lot::query()
        ->whereNotIn('lot_num', $archived_lots_ids)
        ->where('lot_num','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage); */

        $items = BonReception::query()
        //->whereNotIn('lot_num', $archived_lots_ids)
        ->where('ref','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        // $in_progress_lots = Lot::query()
        // ->whereNotIn('lot_num', $in_progress_lots_ids)
        // ->where('lot_num', 'ilike', '%' . $this->search . '%')
        // ->orderBy($this->sortBy, $this->sortDirection)
        // ->paginate($this->perPage);

        return view('livewire.Parametrage.liste-lots',[
            'items'=> $items,
            // 'in_progress_lots' => $in_progress_lots
        ]);
    }

    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        return $this->sortBy = $field;
    }

    public function getLots($id){

        $this->liste_lots = $lot = Lot::where('bon_reception_ref',$id)->get();

        foreach ($this->liste_lots as $key => $value) {
            //$this->lot_id[$key] =$lot->id;
            $value->produit->modeVente->id == 1 ? $this->showNbrPiece = true :  $this->showNbrPiece = false;
            $this->lot_num[$key] =$value->lot_num;
            $this->bon_reception_ref =$value->bon_reception_ref;
            $this->article =$value->produit->nom;
            $this->mode_vente_id =$value->produit->modeVente->id;
            $this->mode_vente =$value->produit->modeVente->nom;

        }
        //dd($lot);
        /* $lot->produit->modeVente->id == 1 ? $this->showNbrPiece = true :  $this->showNbrPiece = false;

        $mode_vente  = $lot->produit->modeVente->id;

        $lot_tranches = LotTranche::where('lot_num', $lot->lot_num)->get();
        //dd($lot,count($lot_tranches),$lot_tranches);

        $lot->produit->modeVente->id != 1 ? $this->countInputs = count($lot_tranches) :  $this->countInputs = 0;

        $this->lot_id =$lot->id;
        $this->lot_num =$lot->lot_num;
        $this->article =$lot->produit->nom;
        $this->mode_vente_id =$lot->produit->modeVente->id;
        $this->mode_vente =$lot->produit->modeVente->nom;

        $this->tranche_id = [];

        foreach ($lot_tranches as $key => $value) {
            //$this->test[$key] = "eee";
            $this->tranche_id[$key] = $value->tranche_id;
            $this->list_tranches[$key] = $mode_vente == 1 ? TranchesPoidsPc::where('uid',$value->tranche_id)->get() : TranchesKgPc::where('uid',$value->tranche_id)->get();
            $this->nom_tranche[$key] = $this->list_tranches[$key][0]->nom;

        } */
        // dump($this->list_tranches);




        // foreach ($lot_tranches as $key => $value) {
        //     if ($mode_vente == 1) {
        //         $this->list_tranches[$key] = TranchesPoidsPc::where('uid', $value->tranche_id)->get();
        //         $this->countInputs = count($this->list_tranches);
        //     } else {
        //         $this->list_tranches[$key] =  TranchesKgPc::where('uid', $value->tranche_id)->get();
        //         $this->countInputs = count($this->list_tranches);
        //     }
        //     //$this->list_tranches[$key] = $mode_vente == 1 ? $list_tranches[$key] = TranchesPoidsPc::where('uid',$value->tranche_id)->get() : $list_tranches[$key] = TranchesKgPc::where('uid',$value->tranche_id)->get();
        //     $this->nom_tranche[$key] = $this->list_tranches[$key][0]->nom;
        //     $this->tranche_uid[$key] = $this->list_tranches[$key][0]->uid;
        // }
        /* foreach ($this->list_tranches as $key => $value) {
            dd($key,$value->get($key)->nom);
        } */


        /* $this->date_capture =$item->date_capture;
        $this->date_entree =$item->date_entree;
        $this->date_preemption =$item->date_preemption;
        $this->pas =$item->pas;
        $this->active =$item->active; */
    }

    public function getStock($id){

        $lot = Lot::where('id',$id)->firstOrFail();
        $lot->produit->modeVente->id == 1 ? $this->showNbrPiece = true :  $this->showNbrPiece = false;

        $mode_vente  = $lot->produit->modeVente->id;

        $lot_tranches = LotTranche::where('lot_num', $lot->lot_num)->get();
        //dd($lot,count($lot_tranches),$lot_tranches);

        $lot->produit->modeVente->id != 1 ? $this->countInputs = count($lot_tranches) :  $this->countInputs = 0;

        $this->lot_id =$lot->id;
        $this->lot_num =$lot->lot_num;
        $this->article =$lot->produit->nom;
        $this->mode_vente_id =$lot->produit->modeVente->id;
        $this->mode_vente =$lot->produit->modeVente->nom;

        $this->tranche_id = [];

        foreach ($lot_tranches as $key => $value) {
            //$this->test[$key] = "eee";
            $this->tranche_id[$key] = $value->tranche_id;
            $this->list_tranches[$key] = $mode_vente == 1 ? TranchesPoidsPc::where('uid',$value->tranche_id)->get() : TranchesKgPc::where('uid',$value->tranche_id)->get();
            $this->nom_tranche[$key] = $this->list_tranches[$key][0]->nom;

        }
        // dump($this->list_tranches);




        // foreach ($lot_tranches as $key => $value) {
        //     if ($mode_vente == 1) {
        //         $this->list_tranches[$key] = TranchesPoidsPc::where('uid', $value->tranche_id)->get();
        //         $this->countInputs = count($this->list_tranches);
        //     } else {
        //         $this->list_tranches[$key] =  TranchesKgPc::where('uid', $value->tranche_id)->get();
        //         $this->countInputs = count($this->list_tranches);
        //     }
        //     //$this->list_tranches[$key] = $mode_vente == 1 ? $list_tranches[$key] = TranchesPoidsPc::where('uid',$value->tranche_id)->get() : $list_tranches[$key] = TranchesKgPc::where('uid',$value->tranche_id)->get();
        //     $this->nom_tranche[$key] = $this->list_tranches[$key][0]->nom;
        //     $this->tranche_uid[$key] = $this->list_tranches[$key][0]->uid;
        // }
        /* foreach ($this->list_tranches as $key => $value) {
            dd($key,$value->get($key)->nom);
        } */


        /* $this->date_capture =$item->date_capture;
        $this->date_entree =$item->date_entree;
        $this->date_preemption =$item->date_preemption;
        $this->pas =$item->pas;
        $this->active =$item->active; */
    }

    public function createStock(){
        if ($this->mode_vente_id == 1) {
            foreach (array_reverse($this->poids) as $key => $value) {
                foreach ($this->list_tranches as $k => $tranche) {
                    if($value >= $tranche[0]['min_poids'] && $value < $tranche[0]['max_poids']){
                        $this->test[$key] = $tranche[0]['uid'];
                    }
                }
            }
        }
        //dd($this->test);
        foreach (array_reverse($this->qte) as $key => $value) {

                if($this->mode_vente_id == 1){

                    // $interval = [];
                    // foreach($this->list_tranches as $k => $tranche){

                    //     if($this->poids[$key] <= $tranche[0]['min_poids'] && $this->poids[$key] < $tranche[0]['max_poids']){
                    //         $interval[$key] = $tranche[0];
                    //     }
                    // }

                    $item = new StockPoidsPc();
                    $item->code =  $this->code[$key];
                    $item->poids =  $this->poids[$key];
                    $item->qte =  $this->qte[$key];
                    $item->prix_achat =  $this->prix_achat[$key];
                    $item->cr =  $this->cr[$key];
                    $item->prix_n =  $this->prix_vente_normal[$key];
                    $item->prix_f =  $this->prix_vente_fidele[$key];
                    $item->prix_p =  $this->prix_vente_business[$key];
                    $item->br_num =  $this->bon_reception[$key];
                    $item->lot_num  =  $this->lot_num;
                    $item->tranche_id =  $this->test[$key];
                    $item->depot_id =  $this->depot[$key];
                    //$item->promo_id =  1;
                    $item->save();


                }else{
                    $item = new StockKgPc();
                    $item->qte =  $this->qte[$key];
                    $item->prix_achat =  $this->prix_achat[$key];
                    $item->cr =  $this->cr[$key];
                    $item->prix_n =  $this->prix_vente_normal[$key];
                    $item->prix_f =  $this->prix_vente_fidele[$key];
                    $item->prix_p =  $this->prix_vente_business[$key];
                    $item->br_num =  $this->bon_reception[$key];
                    $item->lot_num  =  $this->lot_num;
                    $item->tranche_id =  $this->tranche_id[$key];
                    $item->depot_id =  $this->depot[$key];
                    //$item->promo_id =  1;
                    $item->save();
                }

        }

        session()->flash('message', 'Produit "' . $this->article . '" a été ajouté au stock');
        $this->reset(['qte', 'prix_achat', 'cr', 'prix_vente_normal', 'prix_vente_fidele', 'prix_vente_business', 'bon_reception', 'lot_num', 'tranche_id', 'depot','code','poids','article','mode_vente','nombre_piece']);
        return redirect()->to('/stock');


    }

    public function edit($id){

        $item = Livreur::where('id',$id)->firstOrFail();
        $this->livreur_id =$item->id;
        $this->nom =$item->nom;
        $this->cin =$item->cin;
        $this->phone =$item->tel;
        $this->type =$item->type;
        $this->ville_id =$item->ville_id;
        $this->isActive =$item->active;
    }

    public function editLivreur(){

        Livreur::where('id', $this->livreur_id)
            ->update([
                'nom' => $this->nom,
                'cin' => $this->cin,
                'tel' => $this->phone,
                'type' => $this->type,
                'ville_id' => $this->ville_id,
                'active' => $this->isActive,
            ]);

        session()->flash('message', 'Livreur "'.$this->nom.'" à été modifié');
        //return redirect()->to('/livreurs');
    }

    public function deleteLivreur($id)
    {
        $this->render();
        $livreur = Livreur::findOrFail($id);
        $livreur->delete();
    }

    public function saved()
    {
        return $this->render();
    }


}
