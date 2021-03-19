<?php

namespace App\Http\Livewire\Achat;

use App\Models\Article;
use App\Models\BonCommande;
use App\Models\BonCommandeLine;
use App\Models\DemandeAchat;
use App\Models\DemandeAchatLine;
use App\Models\Fournisseur;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class AssigneBonCommande extends Component
{
    use WithPagination;

    public $refDemandeAchat;
    public $refBonCommande;
    public $fournisseurId=[];
    public $date;
    public $ref;
    public $lines_count;
    public $articles=[];
    public $libelle=[];
    public $famille=[];
    public $qte=[];
    public $code=[];
    public $linenumber;
    public $articleId=[];
    public $modeEdit = false;
    public $name=[];
    public $fournisseurs=[];

    public $inputs = [];
    public $i = 0;

    public $qteMagasinier = [];
    public $qteACommander =[];
    public $prix=[];

    protected $rules = [
        'date' => 'required',
        'refBonCommande' => 'required|integer',
    ];


    public function mount()
    {
        $this->ref = request()->ref;
        $list = DemandeAchatLine::where('demande_achat_ref', $this->ref)->get();
        $this->lines_count = count($list);
        $this->i= count($list) + 1;
        $this->ref= $list[0]->demande_achat_ref;
        $this->date = date('Y-m-d');
        $i = 1;
        foreach ($list as $value) {
            $this->articleId[$i] = $value->article->id;
            $this->code[$i] = $value->article->code;
            $this->libelle[$i] = $value->article->libelle;
            $this->famille[$i] = $value->article->famille->famille;
            $this->qteMagasinier[$i] = $value->qte;
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


    public function assignBonCommande(){

        try {

        $this->validate();


        DB::transaction(function () {

            foreach (array_unique($this->fournisseurId) as $key => $value) {

                $ref = $this->refBonCommande.$value;
                BonCommande::create(['date' => $this->date, 'ref' => $ref,'demande_achat_ref' => $this->ref,'validation' => 0, 'fournisseur_id' => $value, 'user_id' => Auth::user()->id]);
            }

            DemandeAchat::where('ref', $this->ref)->update(['validation' => 1]);

            foreach ($this->code as $key => $value) {

                $item = new BonCommandeLine();
                $item->bon_commande_ref = $this->refBonCommande.$this->fournisseurId[$key];
                $item->article_id = $this->articleId[$key];
                $item->libelle_article = $this->libelle[$key];
                if (!empty($this->qteMagasinier[$key])) {
                    $item->qte_magasinier =  $this->qteMagasinier[$key];
                }
                $item->qte_a_commander =  $this->qteACommander[$key];
                $item->prix = $this->prix[$key];$item->fournisseur_id=$this->fournisseurId[$key];
                $item->save();
                //dd($item);



               /* BonCommandeLine::create(['bon_commande_ref' => $this->refBonCommande.$this->fournisseurId[$key], 'article_id' => $this->articleId[$key],'libelle_article' => $this->libelle[$key], 'qte_magasinier' => $this->qteMagasinier[$key], 'qte_a_commander' => $this->qteACommander[$key], 'prix' => $this->prix[$key],'fournisseur_id'=>$this->fournisseurId[$key]]);*/
            }
        });

        session()->flash('message', "Demande achat ref : $this->ref a été transférée.");

        return redirect()->route('create-demande-achat');

        } catch(\Illuminate\Database\QueryException $ex){
        session()->flash('error-message', "Erreur: ".$ex->getMessage());
        }


    }


    public function render()
    {
        $this->refDemandeAchat=request()->ref;

        if(isset($this->code[$this->linenumber]) && !empty($this->code[$this->linenumber])) {

            $this->articles = Article::where('code', 'like', '\\' . $this->code[$this->linenumber] . '%')->orWhere('libelle','like',$this->code[$this->linenumber].'%')->get();

        }

        if(isset($this->name[$this->linenumber]) && !empty($this->name[$this->linenumber])) {
            $this->fournisseurs=Fournisseur::where('name', 'like', '\\'.$this->name[$this->linenumber].'%')->get();
        }



            return view('livewire.achat.assigne-bon-commande', [ 'fournisseurs' => $this->fournisseurs, 'articles' => $this->articles, 'lines_count' => $this->lines_count]);
    }
}
