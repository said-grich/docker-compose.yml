<?php

namespace App\Http\Livewire\Achat;

use App\Models\Article;
use App\Models\BonCommande;
use App\Models\BonCommandeLine;
use App\Models\Fournisseur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class EditBonCommande extends Component
{
    use WithPagination;

    public $ida;
    public $articles=[];
    public $libelle=[];
    public $famille=[];
    public $tva = [];
    public $qte=[];
    public $code=[];
    public $linenumber;
    public $date;
    public $ref;
    public $fournisseurId;
    public $lines_count;
    public $articleId=[];
    public $modeEdit = false;
    public $inputs = [];
    public $i = 0;

    public $qteMagasinier = [];
    public $qteACommander =[];
    public $prix=[];

    protected $rules = [
        'date' => 'required',
        'ref' => 'required',
        'fournisseurId' => 'required|min:1'
    ];

    public function mount()
    {
        $this->ida = request()->ida;

        $list = BonCommandeLine::where('bon_commande_ref', $this->ida)->get();
        $this->lines_count = count($list);
        $this->ref= $list[0]->bon_commande_ref;
        $this->date= $list[0]->bonCommande->date;
        $this->fournisseurId= $list[0]->fournisseur_id;
        $i = 1;
        foreach ($list as $value) {
                $this->articleId[$i] = $value->article->id;
                $this->code[$i] = $value->article->code;
                $this->libelle[$i] = $value->article->libelle;
                $this->famille[$i] = $value->article->famille->famille;
                $this->tva[$i] = $value->article->tva;
                $this->qteMagasinier[$i] = $value->qte_magasinier;
                $this->qteACommander[$i] = $value->qte_a_commander;
                $this->prix[$i] = $value->prix;
                $i++;
        }
    }

    public function editBonCommande()
    {
        $this->validate();

        DB::transaction(function () {
            $item = BonCommande::where('ref', $this->ref)->first();
            $item->date = $this->date;
            $item->ref = $this->ref;
            $item->fournisseur_id = $this->fournisseurId;
            $item->save();

            //BonCommandeLine::where('bon_commande_ref', $this->ref)->update(['mod' => 1]);
            BonCommandeLine::where('bon_commande_ref', $this->ref)->delete();

            foreach ($this->code as $key => $value) {

                BonCommandeLine::create(['bon_commande_ref' => $this->ref, 'article_id' => $this->articleId[$key], 'libelle_article' => $this->libelle[$key], 'libelle_article' => $this->libelle[$key],'qte_a_commander' => $this->qteACommander[$key],'prix' => $this->prix[$key],'fournisseur_id' => $this->fournisseurId]);
            }
        });

        session()->flash('message', 'Modifié avec succès.');
    }

    public function add($i)
    {
        $i = $this->lines_count + 1;
        $this->i = $i;
        array_push($this->inputs , $i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function showArticle($key)
    {
        $this->modeEdit=true;
        $this->linenumber=$key;
    }

    public function getArticle($id,$code, $libelle, $famille,  $tva)
    {
        $this->articleId[$this->linenumber]=$id;
        $this->code[$this->linenumber]=$code;
        $this->libelle[$this->linenumber]=$libelle;
        $this->famille[$this->linenumber]=$famille['famille'];
        $this->tva[$this->linenumber] = $tva;

    }

    public function render()
    {
        if($this->modeEdit === true)
        {
            $this->articles=Article::where('code', 'like', '\\'.$this->code[$this->linenumber].'%')->get();
        }
        $list_fournisseurs = Fournisseur::all()->sortBy('NAME');
        return view('livewire.achat.edit-bon-commande', [ 'list_fournisseurs' => $list_fournisseurs, 'articles' => $this->articles, 'lines_count' => $this->lines_count]);
    }
}
