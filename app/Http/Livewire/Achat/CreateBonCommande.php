<?php

namespace App\Http\Livewire\Achat;

use App\Models\Article;
use App\Models\BonCommande;
use App\Models\BonCommandeLine;
use App\Models\DemandeAchat;
use App\Models\DemandeAchatLine;
use App\Models\Departement;
use App\Models\Fournisseur;
use App\Models\ModePaiement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateBonCommande extends Component
{

    public $articles=[];
    public $libelle=[];
    public $famille=[];
    public $tva = [];
    public $prix=[];
    public $qte=[];
    public $code=[];
    public $articleId=[];
    public $linenumber;
    public $date;
    public $ref;
    public $fournisseurId;
    public $demande_achat_ref;
    public $modePaiementId;

    protected $rules = [
        'date' => 'required',
        'ref' => 'required',
        'fournisseurId' => 'required|min:1'
    ];

    public $inputs = [];
    public $i = 0;

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs , $i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function showArticle($key)
    {
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


    public function saveBonCommande()
    {
        $this->validate();
        try{
            DB::transaction(function () {
                $item = new BonCommande();
                $item->date = $this->date;
                $item->ref = $this->ref;
                $item->demande_achat_ref= 0;
                $item->fournisseur_id = $this->fournisseurId;
                $item->mode_paiement_id = $this->modePaiementId;
                $item->validation = 0;
                $item->user_id = Auth::user()->id;
                $item->save();

                DemandeAchat::where('ref', $this->ref)
                    ->update(['validation' => 0]);

                foreach ($this->code as $key => $value) {

                    /*$item = new BonCommandeLine();
                    $item->bon_commande_ref = $this->ref;
                    $item->article_id = $this->articleId[$key];
                    $item->libelle_article = $this->libelle[$key];
                    //$item->qte_magasinier =  $this->qteMagasinier[$key];
                    $item->qte_a_commander =  $this->qte[$key];
                    $item->prix = $this->prix[$key];
                    $item->fournisseur_id=$this->fournisseurId;
                    $item->save();*/

                    BonCommandeLine::create(['bon_commande_ref' => $this->ref, 'article_id' => $this->articleId[$key],'libelle_article' => $this->libelle[$key], 'qte_a_commander' => $this->qte[$key],'prix' => $this->prix[$key],'fournisseur_id' => $this->fournisseurId]);
                }


            });
            $this->reset(['ref', 'date','fournisseurId','qte','articleId','libelle','prix','famille','code','modePaiementId']);

            session()->flash('message', "La bon commande a été crée.");

            } catch(\Illuminate\Database\QueryException $ex){
                session()->flash('error-message', "Erreur: ".$ex->getMessage());
            }

    }

    public function render()
    {
        $list_fournisseurs = Fournisseur::all()->sortBy('name');
        if(isset($this->code) && !empty($this->code))
        {
            $this->articles=Article::where('code', 'like', '\\'.$this->code[$this->linenumber].'%')->get();
        }

        $list_paiements = ModePaiement::all()->sortBy('name');
        return view('livewire.achat.create-bon-commande', ['list_fournisseurs' => $list_fournisseurs, 'articles' => $this->articles, 'list_paiements' => $list_paiements]);

    }
}
