<?php

namespace App\Http\Livewire\Achat;

use App\Models\Article;
use App\Models\DemandeAchat;
use App\Models\DemandeAchatLine;
use App\Models\Depot;
use App\Models\Site;
use App\Models\Departement;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CreateDemandeAchat extends Component
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
    public $ref;
    public $demande_achat_ref;
    public $depotId;
    public $siteId;

    protected $rules = [
        'date' => 'required',
        'ref' => 'required',
        'depotId' => 'required|min:1',
        'siteId' => 'required|min:1',
        'articleId' => 'required'
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


    public function saveDemandeAchat()
    {


        try {
            $this->validate();

            DB::transaction(function () {
                DemandeAchat::create(['date' => $this->date, 'ref' => $this->ref,'site_id' => $this->siteId, 'depot_id' => $this->depotId, 'user_id' => Auth::user()->id, 'validation' => 0]);


                foreach ($this->code as $key => $value) {
                    DemandeAchatLine::create(['demande_achat_ref' => $this->ref, 'article_id' => $this->articleId[$key],'libelle_article' => $this->libelle[$key], 'qte' => $this->qte[$key], 'mod' => 0]);
                }
            });
            $this->reset(['articles', 'libelle','famille','qte','code','articleId','linenumber','date','ref','demande_achat_ref','depotId','siteId']);


            session()->flash('message', "La demande d'achat ref : $this->ref a été crée.");

        } catch(\Illuminate\Database\QueryException $ex){
            session()->flash('error-message', "Erreur: ".$ex->getMessage());
          }
    }

    public function render()
    {
        $list_departements = Departement::all()->sortBy('departement');
        $list_depots = Depot::all()->sortBy('name');
        $list_sites = Site::all()->sortBy('name');

        if(isset($this->code) && !empty($this->code)){
            $this->articles=Article::where('code', 'like', '\\'.$this->code[$this->linenumber].'%')->get();
       }

        return view('livewire.achat.create-demande-achat', ['list_departements' => $list_departements, 'list_depots' => $list_depots, 'list_sites' => $list_sites, 'articles' => $this->articles]);

    }
}
