<?php

namespace App\Http\Livewire\GestionAchat;

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

class ListeBonReception extends Component
{
    use WithPagination;
    public $tranche_id = [];

    public $lot_id;
    public $lot_num;
    public $article;
    public $produit_id = [];
    public $mode_vente_id;
    public $mode_vente;
    public $nombre_piece;
    public $nom_tranche = [];
    public $test = [];
   // public $tranche_id = [];
    public $code=[];
    public $poids=[];
    public $isActive = false;

    public $list_fournisseurs = [];
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
    public $prix_achat = [];
    public $montant = [];

    public $date_entree;
    public $ref_br;
    public $fournisseur;
    public $depot;
    public $qualite;
    public $br_lignes = [];
    public $montant_total;



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
        /* $lot_stock_kg_pc = array_unique(StockKgPc::pluck('lot_num')->toArray());
        $lot_stock_poids_pc = array_unique(StockPoidsPc::pluck('lot_num')->toArray());
        $archived_lots_ids = array_merge($lot_stock_kg_pc, $lot_stock_poids_pc); */

        $lot_stock_kg_pc = array_unique(StockKgPc::where('cr','=',0)->pluck('br_num')->toArray());
        $lot_stock_poids_pc = array_unique(StockPoidsPc::where('cr','=',0)->pluck('br_num')->toArray());
        //dd($lot_stock_kg_pc,$lot_stock_poids_pc);

        $archived_lots_ids = array_merge($lot_stock_kg_pc, $lot_stock_poids_pc);

        $in_progress_lots_ids = array_unique(BonReception::whereIn('ref', $archived_lots_ids)->pluck('ref')->toArray());
/*         dd($in_progress_lots_ids);
 */
        /* $items = Lot::query()
        ->whereNotIn('lot_num', $archived_lots_ids)
        ->where('lot_num','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage); */

        $items = BonReception::query()
        //->where('ref', $archived_lots_ids)
        ->where('ref','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        // $in_progress_lots = Lot::query()
        // ->whereNotIn('lot_num', $in_progress_lots_ids)
        // ->where('lot_num', 'ilike', '%' . $this->search . '%')
        // ->orderBy($this->sortBy, $this->sortDirection)
        // ->paginate($this->perPage);

        return view('livewire.gestion-achat.liste-bon-reception',[
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

    public function show($id){

        $bon_reception = BonReception::where('ref',$id)->first();
        //dd($bon_reception->geMontantTotal());
        $this->ref_br =$id;
        $this->date_entree = $bon_reception->date;
        $this->fournisseur =$bon_reception->fournisseur->nom;
        $this->depot =$bon_reception->depot->nom;
        $this->qualite =$bon_reception->qualite->nom;
        $this->br_lignes = $bon_reception->bonReceptionLignes;
        $this->montant_total = $bon_reception->geMontantTotal();

    }

    public function edit($id){
        $item = BonReception::where('ref',$id)->firstOrFail();
        $this->ref_br =$id;
        $this->depot =$item->depot->id;
        $this->date_entree =$item->date;
        $this->fournisseur =$item->fournisseur->id;
        $this->qualite =$item->qualite->id;
    }

    public function editBonReception(){

        BonReception::where('ref', $this->ref_br)
            ->update([
                'date' => $this->date_entree,
                'qualite_id' => $this->qualite,
                'depot_id' => $this->depot,
                'fournisseur_id' => $this->fournisseur,
            ]);

        session()->flash('editmessage', 'Bon de réception réf"'.$this->ref_br.'" à été modifié');
        //return redirect()->to('/livreurs');
    }

    public function getLots($id){

        //$this->liste_lots = $lot = Lot::where('bon_reception_ref',$id)->get();
        $this->liste_poids_pc = StockPoidsPc::where('br_num',$id)->get();
        $this->liste_kg_pc = StockKgPc::where('br_num',$id)->get();
       //dd($this->liste_poids_pc,$this->liste_kg_pc);

        foreach ($this->liste_poids_pc as $key => $value) {
            //$this->lot_id[$key] =$lot->id;
            //$value->produit->modeVente->id == 1 ? $this->showNbrPiece = true :  $this->showNbrPiece = false;
            $this->lot_num[$key] =$value->lot_num;
            $this->bon_reception_ref =$id;
            $this->produit_id[$key]  =$value->lot->produit->id;
            $this->article[$key]  =$value->lot->produit->nom;
            $this->nom_tranche[$key] = TranchesPoidsPc::where('uid', $value->tranche_id)->first()->nom;
            $this->poids[$key] = $value->poids;
            $this->code[$key] = $value->code;
           /*  $this->mode_vente_id =$value->produit->modeVente->id;
            $this->mode_vente =$value->produit->modeVente->nom;
 */
        }

        foreach ($this->liste_kg_pc as $k => $v) {
            //dd($v);
            //$this->lot_id[$k] =$lot->id;
            //$v->produit->modeVente->id == 1 ? $this->showNbrPiece = true :  $this->showNbrPiece = false;
            $this->lot_num_kg_pc[$k] =$v->lot_num;
            $this->produit_id_kg_pc[$k]  =$v->lot->produit->id;
            $this->article_kg_pc[$k]  =$v->lot->produit->nom;
            $this->nom_tranche_kc_pc[$k] = TranchesKgPc::where('uid', $v->tranche_id)->first()->nom;
            //$this->code_kg_pc[$k] = $value->code;
           /*  $this->mode_vente_id =$value->produit->modeVente->id;
            $this->mode_vente =$value->produit->modeVente->nom;
 */
        }
        //dd($this->lot_num);

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

    public function affecterPrix()
    {

        foreach ($this->produit_id as $key => $value) {
            $produit = Produit::where('id', $value)->first();
            if ($produit->modeVente->id == 1) {
                StockPoidsPc::where('code', $this->code[$key])
                    ->where('lot_num', $this->lot_num[$key])
                    ->where('br_num', $this->bon_reception_ref)
                    ->update([
                        'cr' => $this->cr[$key],
                        'prix_n' => $this->prix_vente_normal[$key],
                        'prix_f' => $this->prix_vente_fidele[$key],
                        'prix_p' => $this->prix_vente_business[$key],
                        ]);

            }/* else{
                dd($this->nom_tranche_kc_pc);
                StockPoidsPc::where('tranche_id', $this->nom_tranche_kc_pc[$key])
                    ->where('lot_num', $this->lot_num_kg_pc[$key])
                    ->where('br_num', $this->bon_reception_ref)
                    ->update([
                        'cr' => $this->cr_kg_pc[$key],
                        'prix_n' => $this->prix_vente_normal_kg_pc[$key],
                        'prix_f' => $this->prix_vente_fidele_kg_pc[$key],
                        'prix_p' => $this->prix_vente_business_kg_pc[$key],
                        ]);

            } */
            /* $flight = StockPoidsPc::updateOrCreate(
                ['departure' => 'Oakland', 'destination' => 'San Diego'],
                ['price' => 99, 'discounted' => 1]
            ); */
        }

        foreach ($this->produit_id_kg_pc as $key => $value) {
                StockPoidsPc::where('tranche_id', $this->nom_tranche_kc_pc[$key])
                    ->where('lot_num', $this->lot_num_kg_pc[$key])
                    ->where('br_num', $this->bon_reception_ref)
                    ->update([
                        'cr' => $this->cr_kg_pc[$key],
                        'prix_n' => $this->prix_vente_normal_kg_pc[$key],
                        'prix_f' => $this->prix_vente_fidele_kg_pc[$key],
                        'prix_p' => $this->prix_vente_business_kg_pc[$key],
                        ]);

            }
            /* $flight = StockPoidsPc::updateOrCreate(
                ['departure' => 'Oakland', 'destination' => 'San Diego'],
                ['price' => 99, 'discounted' => 1]
            ); */
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
