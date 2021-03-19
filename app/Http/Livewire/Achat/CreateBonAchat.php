<?php

namespace App\Http\Livewire\Achat;

use App\Models\Article;
use App\Models\BonAchat;
use App\Models\BonAchatLine;
use App\Models\BonCommande;
use App\Models\BonCommandeLine;
use App\Models\Charge;
use App\Models\ChargeLine;
use App\Models\Depot;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Site;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateBonAchat extends Component
{
    public $articles=[];
    public $libelle=[];
    public $famille=[];
    public $tva = [];
    public $qte=[];
    public $code=[];
    public $articleId=[];
    public $linenumber;
    public $date;
    public $dateBlFournisseur;
    public $ref;
    public $fournisseurId;
    public $depotId;
    public $siteId;
    public $numLot = [];
    public $prixAchat=[];
    public $montant=[];
    public $montanttva = [];


    public $totalMts = [];
    public $totalTtcs = [];
    public $totalTvas = [];
    public $tauxTva=[];

    public $totalMt;
    public $totalTva;
    public $totalTtc;
    public $bonCommadeRef;
    public $showListBc = "false";
    public $modeCreate = false;
    public $listBC;
    public $bonCommandeId;
    public $lines_count = 0;


    protected $rules = [
        'date' => 'required',
        'dateBlFournisseur' => 'required',
        'ref' => 'required',
        'depotId' => 'required|min:1',
        'siteId' => 'required|min:1',
        'fournisseurId' => 'required|min:1'
    ];

    public $inputs = [];
    public $i = 0;



    public function updatedFournisseurId($fournisseurId)
    {
        $this->reset(['qte','articleId','libelle','prixAchat','famille','code','montant', 'totalMt', 'totalTva', 'totalTtc']);

        $this->listBC = BonCommande::where('fournisseur_id', $this->fournisseurId)->get();

        if(count($this->listBC)>0){
            $this->showListBc = true;
        }else{
            $this->showListBc = false;
        }

        /* $list = BonCommandeLine::where('fournisseur_id', $this->fournisseurId)
                                ->where('bon_commande_ref' , $this->bonCommandeId)
                                ->get(); */

    }

    public function updatedBonCommandeId($bonCommandeId)
    {
        $list = BonCommandeLine::where('bon_commande_ref' , $this->bonCommandeId)->get();
        $this->lines_count = count($list)-1;

        $i = 0;
        foreach ($list as $value) {

            $this->articleId[$i] = $value->article->id;
            $this->code[$i] = $value->article->code;
            $this->libelle[$i] = $value->article->libelle;
            $this->famille[$i] = $value->article->famille->famille;
            $this->tva[$i] = $value->article->tva;
            $this->prixAchat[$i] = $value->prix;
            $this->qte[$i] = $value->qte_a_commander;
            $this->updateData($i);
            //$this->montant[$i] = $this->qte[$i] * $this->prixAchat[$i] ;
            $i++;
        }

    }

    public function updateData($i)
    {
        // dd($this);

        /* if (isset($this->prixAchat[$i]) && isset($this->qte[$i])) {


            array_splice($this->montant, $i, 1, $this->prixAchat[$i] > 0 ? $this->qte[$i] * $this->prixAchat[$i] : $this->qte[$i] * 0);

            $this->totalMt = 0;
            for ($i = 0; $i < count($this->montant); $i++) {
                $this->totalMt += $this->montant[$i];
            }

            $this->totalTtc = $this->totalMt * 1.2;

            $this->totalTva = $this->totalTtc / 6;
        } */

        if (isset($this->prixAchat[$i]) && isset($this->qte[$i])) {


            array_splice($this->montant, $i, 1, $this->prixAchat[$i] > 0 ? $this->qte[$i] * $this->prixAchat[$i] : $this->qte[$i] * 0);

            array_splice($this->montanttva, $i, 1, $this->tva[$i] > 0 ? $this->qte[$i] * ($this->prixAchat[$i] * ($this->tva[$i] / 100)) : $this->tva[$i] * 0);

            $this->totalMts = [];
            $this->totalTtcs = [];
            $this->totalTvas = [];

            for ($i = 0; $i < count($this->tva); $i++) {
                if (array_key_exists(strval($this->tva[$i]), $this->totalTvas)) {
                    $this->totalTvas[strval($this->tva[$i])] += $this->montanttva[$i];

                    $this->totalMts[strval($this->tva[$i])] = $this->totalMts[strval($this->tva[$i])] + $this->montant[$i];
                    $this->totalTtcs[strval($this->tva[$i])] = $this->totalMts[strval($this->tva[$i])] + $this->totalTvas[strval($this->tva[$i])];
                } else {
                    //dd(strval($this->montanttva[$i]));
                    $this->totalTvas[strval($this->tva[$i])] = $this->montanttva[$i];

                    $this->totalMts[strval($this->tva[$i])] =  $this->montant[$i];
                    $this->totalTtcs[strval($this->tva[$i])] = $this->totalMts[strval($this->tva[$i])] + $this->totalTvas[strval($this->tva[$i])];
                }
            }

            $this->totalMt = 0;
            for ($i = 0; $i < count($this->montant); $i++) {
                $this->totalMt += $this->montant[$i];
            }

            $this->totalTva = 0;
            for ($i = 0; $i < count($this->montanttva); $i++) {
                $this->totalTva += $this->montanttva[$i];
            }
            //dd($this->totalTtcs);

            $this->totalTtc = $this->totalMt + $this->totalTva;

            //$tauxTva =[];

        }
    }


     public function add($i)
    {
        $i = count($this->inputs) + $this->lines_count + 1;
        $this->i = $i;
        array_push($this->inputs , $i);
    }


    /* public function remove($i)
    {
        unset($this->inputs[$i]);
    } */

    /* public function add()
    {
        dump($this->i,count($this->montant));
        $i = count($this->inputs) + $this->lines_count + 1;
        dump($i);
        $this->i = $i;
        if($this->i < count($this->montant)){
            $this->i ++;
            array_push($this->inputs, $this->i);
        }
    } */

    public function remove($i)
    {
        array_splice($this->inputs, $i-1, 1);
        $this->i --;
        array_splice($this->qte, $i, 1);
        array_splice($this->prixAchat, $i, 1);
        array_splice($this->montant, $i, 1);

        $this->totalMt = 0;

        foreach ($this->montant as $value) {
            $this->totalMt += $value;
        }

        $this->totalTtc = $this->totalMt * 1.2;

        $this->totalTva = $this->totalTtc / 6;
        // dd($this);
    }

    public function showArticle($key)
    {
        $this->modeCreate=true;
        $this->linenumber=$key;
    }



    public function getArticle($id,$code, $libelle, $famille,$tva)
    {
        $this->articleId[$this->linenumber]=$id;
        $this->code[$this->linenumber]=$code;
        $this->libelle[$this->linenumber]=$libelle;
        $this->famille[$this->linenumber]=$famille['famille'];
        $this->tva[$this->linenumber] = $tva;


    }


    public function saveBonAchat()
    {
        //$this->validate();

        /* foreach($this->totalTvas as $key=>$val){
            array_push( $this->tauxTva,$key);

        } */
        //dd($this->totalTvas);

        try{
            DB::transaction(function () {
                $item = new BonAchat();
                $item->date = $this->date;
                $item->date_bl_fournisseur = $this->dateBlFournisseur;
                $item->ref = $this->ref;
                //$item->num_lot = $this->numLot;
                $item->site_id = $this->siteId;
                $item->depot_id = $this->depotId;
                $item->fournisseur_id = $this->fournisseurId;
                $item->user_id = Auth::user()->id;
                $item->validation = isset($this->totalMt) ? true : false;
                //dd($this->totalMt, isset($this->totalMt), $item->validation);
                $item->total_ht = $this->totalMt;
                $item->total_tva = $this->totalTva;
                $item->total_ttc = $this->totalTtc;
                $item->save();

                foreach ($this->code as $key => $value) {


                BonAchatLine::create([
                    'bon_achat_ref' => $this->ref,
                    'article_id' => $this->articleId[$key],
                    'libelle_article' => $this->libelle[$key],
                    'num_lot' => $this->numLot[$key],
                    'qte' => $this->qte[$key],
                    'prix_achat' => $this->prixAchat[$key],
                    'taux_tva' => $this->tva[$key],
                    'montant' => $this->montant[$key],
                    'montant_tva' => $this->montanttva[$key],
                ]);

                Produit::updateOrCreate([ 'depot_id' => $this->depotId,'site_id' => $this->siteId, 'bon_reception_id' => $this->ref, 'num_lot' => $this->numLot[$key], 'article_id' => $this->articleId[$key], 'qte' => $this->qte[$key], 'prix_achat' => $this->prixAchat[$key]]);


                }

                $item = new Charge();
                $item->ref =$this->ref;
                $item->montant_total_ht = $this->totalMt;
                $item->montant_total_ttc = $this->totalTtc;
                $item->site_id = $this->siteId;
                $item->bon_reception_ref = $this->ref;
                $item->user_id = Auth::user()->id;
                $item->save();


                $fournisseur = Fournisseur::where('id', $this->fournisseurId)->first();

                $item = new ChargeLine();
                $item->date = $this->date;
                $item->num_facture = $this->ref;
                $item->libelle = "FN ".$this->ref." ".$fournisseur->name;
                $item->montant_ht = $this->totalMts;
                //$item->ventilation = [];
                $item->fournisseur_id = $this->fournisseurId;
                $item->compte_comptable_fournisseur_id = $fournisseur->code_comptable;
                $item->montant_tva = $this->totalTvas;
                $item->montant_ttc = $this->totalTtcs;
                $item->compte_comptable_fournisseur_id = $fournisseur->code_comptable;
                //$item->compte_comptable_ht_id = $fournisseur->code_comptable;
                //$item->compte_comptable_Tva_id = $fournisseur->code_comptable;
                $item->charge_ref =$this->ref;
                $item->save();

            });
            $this->lines_count = 0;
            $this->inputs = array();


            session()->flash('message', "Le bon réception $this->ref a été crée.");

            $this->reset(['ref', 'date','dateBlFournisseur','fournisseurId','siteId','depotId','ref','numLot','qte','articleId','libelle','prixAchat','famille','code','montant', 'totalMt', 'totalTva', 'totalTtc', 'tva','totalTvas']);


        } catch(\Illuminate\Database\QueryException $ex){
            session()->flash('error-message', "Erreur: ".$ex->getMessage());
        }

    }

    public function render()
    {
        $list_fournisseurs = Fournisseur::all()->sortBy('name');
        $list_depots = Depot::all()->sortBy('name');
        $list_sites = Site::all()->sortBy('name');

        if($this->modeCreate === true && isset($this->code) && !empty($this->code)){
             $this->articles=Article::where('code', 'like', '\\'.$this->code[$this->linenumber].'%')->get();
        }

        return view('livewire.achat.create-bon-achat', ['list_fournisseurs' => $list_fournisseurs, 'list_depots' => $list_depots, 'list_sites' => $list_sites, 'articles' => $this->articles, 'lines_count' => $this->lines_count]);

    }

}
