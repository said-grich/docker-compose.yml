<?php

namespace App\Http\Livewire\Achat;

use App\Models\Article;
use App\Models\BonAchat;
use App\Models\BonAchatLine;
use App\Models\Depot;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Site;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class EditBonAchat extends Component
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
    public $dateBlFournisseur;
    public $ref;
    public $depotId;
    public $siteId;
    public $fournisseurId;
    public $lines_count;
    public $articleId=[];
    public $prixAchat=[];
    public $montant=[];
    public $montanttva = [];
    public $numLot;
    public $modeEdit = false;
    public $inputs = [];
    public $i = 0;
    public $totalMt;
    public $totalTva;
    public $totalTtc;

    protected $rules = [
        'date' => 'required',
        'dateBlFournisseur' => 'required',
        'ref' => 'required',
        'numLot' => 'required|integer',
        'depotId' => 'required|min:1',
        'siteId' => 'required|min:1',
        'fournisseurId' => 'required|min:1'
    ];

    public function mount()
    {
        $this->ida = request()->ida;

        $list = BonAchatLine::where('bon_achat_ref', $this->ida)->get();
        $this->lines_count = count($list);
        $this->ref= $list[0]->bon_achat_ref;
        $this->date= $list[0]->bonAchat->date;
        $this->dateBlFournisseur= $list[0]->bonAchat->date_bl_fournisseur;
        $this->siteId= $list[0]->bonAchat->site_id;
        $this->depotId= $list[0]->bonAchat->depot_id;
        $this->numLot= $list[0]->bonAchat->num_lot;
        $this->fournisseurId= $list[0]->bonAchat->fournisseur_id;
        $this->totalMt= $list[0]->bonAchat->total_ht;
        $this->totalTva= $list[0]->bonAchat->total_tva;
        $this->totalTtc= $list[0]->bonAchat->total_ttc;

        $i = 0;
        foreach ($list as $value) {
                $this->articleId[$i] = $value->article->id;
                $this->code[$i] = $value->article->code;
                $this->libelle[$i] = $value->article->libelle;
                $this->famille[$i] = $value->article->famille->famille;
                $this->tva[$i] = $value->article->tva;
                $this->qte[$i] = $value->qte;
                $this->prixAchat[$i] = $value->prix_achat;
                $this->montant[$i] = $value->montant;
                array_splice($this->montanttva, $i, 1, $this->tva[$i] > 0 ? $this->qte[$i] * ($this->prixAchat[$i] * ($this->tva[$i]/100)) : $this->tva[$i] * 0);
                $i++;
        }
    }

    public function updateData($i)
    {
        // dd($this);

        if (!isset($this->tva[$i])){
            $this->tva[$i] = 0;
        }

        if (isset($this->prixAchat[$i]) && isset($this->qte[$i])) {


            // dd($this);
            array_splice($this->montant, $i, 1, $this->prixAchat[$i] > 0 ? $this->qte[$i] * $this->prixAchat[$i] : $this->qte[$i] * 0);

            array_splice($this->montanttva, $i, 1, $this->tva[$i] > 0 ? $this->qte[$i] * ($this->prixAchat[$i] * ($this->tva[$i]/100)) : $this->tva[$i] * 0);

            $this->totalMt = 0;
            for ($i = 0; $i < count($this->montant); $i++) {
                $this->totalMt += $this->montant[$i];
            }

            $this->totalTva = 0;
            for ($i = 0; $i < count($this->montanttva); $i++) {
                $this->totalTva += $this->montanttva[$i];
            }

            $this->totalTtc = $this->totalMt + $this->totalTva;
        }
    }

    public function editBonAchat()
    {
        $this->validate();

        DB::transaction(function () {
            $item = BonAchat::where('ref', $this->ref)->first();
            $item->date = $this->date;
            $item->date_bl_fournisseur = $this->dateBlFournisseur;
            $item->ref = $this->ref;
            $item->num_lot = $this->numLot;
            $item->site_id = $this->siteId;
            $item->depot_id = $this->depotId;
            $item->fournisseur_id = $this->fournisseurId;
            $item->total_ht = $this->totalMt;
            $item->total_tva = $this->totalTva;
            $item->total_ttc = $this->totalTtc;
            $item->save();

            BonAchatLine::where('bon_achat_ref', $this->ref)->delete();


            foreach ($this->code as $key => $value) {

                BonAchatLine::create(['bon_achat_ref' => $this->ref, 'article_id' => $this->articleId[$key], 'libelle_article' => $this->libelle[$key],'qte' => $this->qte[$key],'prix_achat' => $this->prixAchat[$key],'montant' => $this->montant[$key]]);

                Produit::where('num_lot', $this->numLot)
                    ->where('article_id', $this->articleId[$key])
                    ->where('depot_id', $this->depotId)
                    ->update(['qte' => $this->qte[$key], 'prix_achat' => $this->prixAchat[$key]]);

            }
        });
        session()->flash('message', 'Modifié avec succès.');
    }

    public function add()
    {
        // dd($this->i);
        if ($this->lines_count === count($this->montant)) {
            $this->lines_count++;
        }
    }

    public function remove($i)
    {
        $this->lines_count--;
        array_splice($this->code, $i, 1);
        array_splice($this->articleId, $i, 1);
        array_splice($this->libelle, $i, 1);
        array_splice($this->tva, $i, 1);
        array_splice($this->qte, $i, 1);
        array_splice($this->prixAchat, $i, 1);
        array_splice($this->montant, $i, 1);
        array_splice($this->montanttva, $i, 1);

        $this->totalMt = 0;
        foreach ($this->montant as $value) {
            $this->totalMt += $value;
        }

        $this->totalTva = 0;
        foreach ($this->montanttva as $value) {
            $this->totalTva += $value;
        }

        $this->totalTtc = $this->totalMt + $this->totalTva;
        // dd($this);
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
        if($this->modeEdit === true){

            $this->articles=Article::where('code', 'like', '\\'.$this->code[$this->linenumber].'%')->get();

        }

        $list_fournisseurs = Fournisseur::all()->sortBy('name');
        $list_depots = Depot::all()->sortBy('name');
        $list_sites = Site::all()->sortBy('name');

        return view('livewire.achat.edit-bon-achat', [ 'list_depots' => $list_depots, 'list_sites' => $list_sites,'list_fournisseurs' => $list_fournisseurs, 'articles' => $this->articles, 'lines_count' => $this->lines_count]);
    }
}
