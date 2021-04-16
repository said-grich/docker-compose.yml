<?php

namespace App\Http\Livewire\Vente;

use App\Models\BonReception;
use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Stock;
use App\Models\StockKgPc;
use App\Models\StockPoidsPc;
use App\Models\Tranche;
use App\Models\TranchesKgPc;
use App\Models\TranchesPoidsPc;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class DesignationPrix extends Component
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
    public $cr = [];
    public $depot = [];
    public $prix_achat = [];
    public $prix_vente_normal = [];
    public $prix_vente_fidele = [];
    public $prix_vente_business = [];
    public $tranche_uid = [];
    public $bon_reception = [];
    public $liste_lots= [];
    public $bon_reception_ref;

    public $article_kg_pc=[];
    public $produit_id_kg_pc=[];
    public $lot_num_kg_pc=[];
    public $cr_kg_pc=[];
    public $uid_tranche_kg_pc = [];
    public $nom_tranche_kg_pc = [];
    public $id_kg_pc = [];
    public $prix_vente_normal_kg_pc=[];
    public $prix_vente_fidele_kg_pc=[];
    public $prix_vente_business_kg_pc=[];
    public $categorie = [];
    public $categorie_id = [];



    public $sortBy = 'valide';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render(){

        $items = BonReception::query()
        ->where('ref','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.vente.designation-prix',[
            'items'=> $items,
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

    public function designationPrix($id){

        // $this->liste_poids_pc = collect(StockPoidsPc::where('br_num', $id)->get()->groupBy(['tranche_id', 'produit_id']));
        // $this->liste_kg_pc = StockKgPc::where('br_num', $id)->get();

        $this->liste_poids_pc = Stock::where('br_num', $id)->where('type', "Poids par pièce")->get()->groupBy(['tranche_id','categorie_id' ,'produit_id'])->toArray();
        //dd($this->liste_poids_pc);
        //$this->liste_poids_pc2 = Stock::where('br_num', $id)->where('type', "Poids par pièce")->get()->groupBy(['tranche_id', 'produit_id','lot_num']);

        //dd($this->liste_poids_pc2);

        $this->liste_kg_pc = Stock::where('br_num', $id)->where('type', '!=', "Poids par pièce")->get();
        //dd($this->liste_poids_pc, $this->liste_kg_pc);

        $this->bon_reception_ref = $id;


        /* groupement par lot
        foreach ($this->liste_poids_pc as $tranche => $produits) {

            foreach ($produits as $produit => $lots){
                $this->article[$tranche] = Produit::where('id', $produit)->first()->nom;

                foreach ($lots as $lot => $details){

                    foreach ($details as $key => $v){
                        //$this->lot_num[$tranche][$lot] =$lot;
                        $this->produit_id[$tranche]  =$v->produit_id;
                        $this->nom_tranche[$tranche]  = Tranche::where('uid', $v->tranche_id)->first()->nom;
                        $this->tranche_uid[$tranche]  = $v->tranche_id;
                        $this->poids[$tranche] = $v->pas;
                        $this->code[$tranche] = $v->code;
                        //$this->lot_num[$tranche] = $v->lot_num;
                    }

                }
            }

        } */
        //dd($this->lot_num);


        foreach ($this->liste_poids_pc as $tranche => $categories) {

            foreach ($categories as $categorie => $produits){

                $this->categorie[$categorie]  = Categorie::where('id', $categorie)->first()->nom;


                foreach ($produits as $produit => $stock){

                    foreach ($stock as $key => $item){
                        $this->article[$tranche] = Produit::where('id', $produit)->first()->nom;
                        $this->produit_id[$key] = $item['produit_id'];
                        $this->categorie_id[$key]  = $item['categorie_id'];
                        $this->nom_tranche[$tranche] = Tranche::where('uid', $tranche)->first()->nom;
                        $this->tranche_uid[$key] = $tranche;

                    }

                }
            }

        }




        foreach ($this->liste_kg_pc as $k => $v) {

            $this->id_kg_pc[$k] = $v->id;
            $this->lot_num_kg_pc[$k] =$v->lot_num;
            $this->produit_id_kg_pc[$k]  =$v->lot->produit->id;
            $this->article_kg_pc[$k]  =$v->lot->produit->nom;
            $this->nom_tranche_kg_pc[$k] = Tranche::where('uid', $v->tranche_id)->first()->nom;
            $this->uid_tranche_kg_pc[$k] = Tranche::where('uid', $v->tranche_id)->first()->uid;

        }


        // $this->liste_poids_pc = StockPoidsPc::where('br_num',$id)->get();
        // $this->liste_kg_pc = StockKgPc::where('br_num',$id)->get();


        // foreach ($this->liste_poids_pc as $key => $value) {
        //     $this->lot_num[$key] =$value->lot_num;
        //     $this->produit_id[$key]  =$value->lot->produit->id;
        //     $this->article[$key]  =$value->lot->produit->nom;
        //     $this->nom_tranche[$key] = TranchesPoidsPc::where('uid', $value->tranche_id)->first()->nom;
        //     $this->poids[$key] = $value->poids;
        //     $this->code[$key] = $value->code;
        // }
    }

    public function show($id)
    {


        // $this->liste_poids_pc = collect(StockPoidsPc::where('br_num', $id)->get()->groupBy(['tranche_id', 'produit_id']));
        // $this->liste_kg_pc = StockKgPc::where('br_num', $id)->get();

        $this->liste_poids_pc = Stock::where('br_num', $id)->where('type', "Poids par pièce")->get()->groupBy(['tranche_id', 'produit_id']);
        $this->liste_kg_pc = Stock::where('br_num', $id)->where('type', '!=', "Poids par pièce")->get();
        $this->bon_reception_ref = $id;


        foreach ($this->liste_poids_pc as $key => $value) {
            $this->nom_tranche[$key] = Tranche::where('uid', $key)->first()->nom;

            foreach ($value as $produit => $details) {
                $this->article[$key] = Produit::where('id', $produit)->first()->nom;
                foreach ($details as $k => $v) {
                    $this->lot_num[$key] = $v->lot_num;
                    $this->produit_id[$key]  = $v->produit_id;
                    //$this->produit_id[$key]  = $v->lot->produit->nom;
                    $this->nom_tranche[$key]  = Tranche::where('uid', $v->tranche_id)->first()->nom;
                    $this->tranche_uid[$key]  = $v->tranche_id;
                    $this->poids[$key]  = $v->pas;
                    $this->code[$key] = $v->code;
                    $this->lot_num[$key] = $v->lot_num;
                    $this->cr[$key] = $v->cr;
                    $this->prix_vente_normal[$key] = $v->prix_n;
                    $this->prix_vente_fidele[$key] = $v->prix_f;
                    $this->prix_vente_business[$key] = $v->prix_p;
                }
            }
        }

        foreach ($this->liste_kg_pc as $k => $v) {
            $this->id_kg_pc[$k] = $v->id;
            $this->lot_num_kg_pc[$k] = $v->lot_num;
            $this->produit_id_kg_pc[$k]  = $v->lot->produit->id;
            $this->article_kg_pc[$k]  = $v->lot->produit->nom;
            $this->nom_tranche_kg_pc[$k] = Tranche::where('uid', $v->tranche_id)->first()->nom;
            $this->uid_tranche_kg_pc[$k] = Tranche::where('uid', $v->tranche_id)->first()->uid;
            $this->cr_kg_pc[$k] = $v->cr;
            $this->prix_vente_normal_kg_pc[$k] = $v->prix_n;
            $this->prix_vente_fidele_kg_pc[$k] = $v->prix_f;
            $this->prix_vente_business_kg_pc[$k] = $v->prix_p;
        }
    }

    public function affecterPrix(){
        //dd($this->categorie_id, $this->produit_id,$this->prix_vente_normal,$this->tranche_uid);

        DB::transaction( function () {

            foreach ($this->produit_id as $key => $value) {
                $produit = Produit::where('id', $value)->first();
                if ($produit->modeVente->id == 1) {
                    Stock::where('produit_id', $this->produit_id[$key])
                        //->where('lot_num', $this->lot_num[$key])
                        ->where('tranche_id', $this->tranche_uid[$key])
                        ->where('categorie_id', $this->categorie_id[$key])
                        ->where('br_num', $this->bon_reception_ref)
                        ->update([
                            //'cr' => $this->cr[$key],
                            'prix_n' => $this->prix_vente_normal[$this->tranche_uid[$key]],
                            'prix_f' => $this->prix_vente_fidele[$this->tranche_uid[$key]],
                            'prix_p' => $this->prix_vente_business[$this->tranche_uid[$key]],
                            ]);
                }
            }
            foreach ($this->produit_id_kg_pc as $key => $value) {

                Stock::where('tranche_id', $this->uid_tranche_kg_pc[$key])
                ->where('produit_id', $value)
                ->where('id', $this->id_kg_pc[$key])
                //->where('lot_num', $this->lot_num_kg_pc[$key])
                ->where('br_num', $this->bon_reception_ref)
                ->update([
                    //'cr' => $this->cr_kg_pc[$key],
                    'prix_n' => $this->prix_vente_normal_kg_pc[$key],
                    'prix_f' => $this->prix_vente_fidele_kg_pc[$key],
                    'prix_p' => $this->prix_vente_business_kg_pc[$key],
                    ]);


            }
            BonReception::where('ref', $this->bon_reception_ref) ->update(['valide' => true]);

            session()->flash('message', 'Les prix du BR "' . $this->bon_reception_ref . '" sont désignés');
            //$this->reset(['uid_tranche_kg_pc', 'produit_id_kg_pc','id_kg_pc','depot','client']);
        });



    }


    public function saved()
    {
        return $this->render();
    }

}
