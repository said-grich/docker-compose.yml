<?php

namespace App\Http\Livewire\Achat;

use App\Models\Article;
use App\Models\BonAchat;
use App\Models\BonAchatLine;
use App\Models\BonCommande;
use App\Models\BonCommandeLine;
use App\Models\DemandeAchat;
use App\Models\DemandeAchatLine;
use App\Models\Depot;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Site;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class TransfertBonCommande extends Component
{
    use WithPagination;

    public $refBonReception;
    public $articles=[];
    public $lines_count;
    public $libelle=[];
    public $famille=[];
    public $qte=[];
    public $code=[];
    public $articleId=[];
    public $linenumber;
    public $date;
    public $dateBlFournisseur;
    public $ref;
    public $fournisseur;
    public $fournisseurId;
    public $depotId;
    public $siteId;
    public $numLot;
    public $prixAchat=[];
    public $montant=[];
    public $totalHt;
    public $totalTva;
    public $totalTtc;

    public $inputs = [];
    public $i = 0;

    public $qteCommandee =[];
    public $qteRecu =[];

    protected $rules = [
        'date' => 'required',
        'ref' => 'required',
        'fournisseurId' => 'required|min:1'
    ];


    public function mount()
    {
        $this->ref = request()->ref;
        $list = BonCommandeLine::where('bon_commande_ref', $this->ref)->get();

        $this->lines_count = count($list);
        $this->i= count($list) + 1;
        $this->ref= $list[0]->bon_commande_ref;
        $this->date= $list[0]->bonCommande->date;
        $this->fournisseurId= $list[0]->bonCommande->fournisseur_id;
        $this->fournisseur= $list[0]->bonCommande->fournisseur->name;
        $i = 1;
        foreach ($list as $value) {
            $this->articleId[$i] = $value->article->id;
            $this->code[$i] = $value->article->code;
            $this->libelle[$i] = $value->article->libelle;
            $this->famille[$i] = $value->article->famille->famille;
            $this->qteCommandee[$i] = $value->qte_a_commander;
            $i++;
        }
    }

    public function add($i)
    {
        $i = $i + 1;
        //$i = $this->lines_count + 1;
        $this->i = $i;
        array_push($this->inputs , $i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function showArticle($key)
    {
        //$this->modeEdit=true;
        $this->linenumber=$key;
    }

    public function getArticle($id,$code, $libelle, $famille)
    {
        $this->articleId[$this->linenumber]=$id;
        $this->code[$this->linenumber]=$code;
        $this->libelle[$this->linenumber]=$libelle;
        $this->famille[$this->linenumber]=$famille;
    }

    public function showFournisseur($key)
    {
        $this->linenumber=$key;
    }

    public function getFournisseur($id,$name)
    {
        $this->fournisseurId[$this->linenumber]=$id;
        $this->name[$this->linenumber]=$name;
    }


    public function transfertBonCommande(){

        //$this->validate();


        DB::transaction(function () {

            $item = new BonAchat();
            $item->date = $this->date;
            $item->date_bl_fournisseur = $this->dateBlFournisseur;
            $item->ref = $this->refBonReception;
            $item->num_lot = $this->numLot;
            $item->site_id = $this->siteId;
            $item->depot_id = $this->depotId;
            $item->fournisseur_id = $this->fournisseurId;
            $item->user_id = Auth::user()->id;
            $item->total_ht = $this->totalHt;
            $item->total_tva = $this->totalTva;
            $item->total_ttc = $this->totalTtc;
            $item->save();


            BonCommande::where('ref', $this->ref)->update(['validation' => 1]);

            foreach ($this->code as $key => $value) {
                BonAchatLine::create(['bon_achat_ref' => $this->refBonReception, 'article_id' => $this->articleId[$key],'libelle_article' => $this->libelle[$key], 'qte' => $this->qteRecu[$key], 'prix_achat' => $this->prixAchat[$key], 'montant' => $this->montant[$key]]);

                Produit::create(['num_lot' => $this->numLot, 'article_id' => $this->articleId[$key], 'depot_id' => $this->depotId,'site_id' => $this->siteId, 'qte' => $this->qteRecu[$key], 'prix_achat' => $this->prixAchat[$key]]);


            }
        });

        session()->flash('message', "Le bon commande ref : $this->ref a été transféré.");

        return redirect()->route('create-bon-commande');


    }


    public function render()
    {
        $this->refDemandeAchat=request()->ref;

        $list_depots = Depot::all()->sortBy('name');
        $list_sites = Site::all()->sortBy('name');
        $list_fournisseurs = Fournisseur::all()->sortBy('name');

        if(isset($this->code[$this->linenumber]) && !empty($this->code[$this->linenumber])) {

            $this->articles = Article::where('code', 'like', '\\' . $this->code[$this->linenumber] . '%')->orWhere('libelle','like',$this->code[$this->linenumber].'%')->get();

        }



        return view('livewire.achat.transfert-bon-commande', ['articles' => $this->articles, 'lines_count' => $this->lines_count, 'list_depots' => $list_depots,'list_sites'=>$list_sites,'list_fournisseurs'=> $list_fournisseurs ]);
    }
}
