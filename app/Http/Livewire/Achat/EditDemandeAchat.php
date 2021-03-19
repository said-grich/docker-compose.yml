<?php

namespace App\Http\Livewire\Achat;

use App\Models\Article;
use App\Models\DemandeAchat;
use App\Models\DemandeAchatLine;
use App\Models\Depot;
use App\Models\Site;
use App\Models\Departement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class EditDemandeAchat extends Component
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
    public $departementId;
    public $depotId;
    public $siteId;
    public $lines_count;
    public $articleId=[];
    public $modeEdit = false;
    public $inputs = [];
    public $i = 0;

    protected $rules = [
        'date' => 'required',
        'ref' => 'required',
        'depotId' => 'required|min:1',
        'siteId' => 'required|min:1',
    ];

    public function mount()
    {
        $this->ida = request()->ida;
        $list = DemandeAchatLine::where('demande_achat_ref', $this->ida)->where('mod', 0)->get();
        //dd($list[0]->demandeAchat);
        $this->lines_count = count($list);
        $this->ref= $list[0]->demande_achat_ref;
        $this->date= $list[0]->demandeAchat->date;
        $this->departementId= $list[0]->demandeAchat->departement_id;
        $this->siteId= $list[0]->demandeAchat->site_id;
        $this->depotId= $list[0]->demandeAchat->depot_id;
        $i = 1;
        foreach ($list as $value) {
                $this->articleId[$i] = $value->article->id;
                $this->code[$i] = $value->article->code;
                $this->libelle[$i] = $value->article->libelle;
                $this->famille[$i] = $value->article->famille->famille;
                $this->qte[$i] = $value->qte;
                $this->tva[$i] = $value->article->tva;
                $i++;
        }

        $j = $this->lines_count + 1;
        for($j=1; $j<=$this->lines_count; $j++){
        array_push($this->inputs , $j);
        }
    }

    public function editDemandeAchat()
    {

        try{
            $this->validate();
            DB::transaction(function () {
                $item = DemandeAchat::where('ref', $this->ref)->first();
                $item->date = $this->date;
                $item->ref = $this->ref;
                $item->site_id = $this->siteId;
                $item->depot_id = $this->depotId;
                $item->save();

                DemandeAchatLine::where('demande_achat_ref', $this->ref)
                    ->update(['mod' => 1]);

                DemandeAchatLine::where('demande_achat_ref', $this->ref)->delete();

                foreach ($this->code as $key => $value) {

                    DemandeAchatLine::updateOrCreate(['demande_achat_ref' => $this->ref, 'article_id' => $this->articleId[$key], 'libelle_article' => $this->libelle[$key],'qte' => $this->qte[$key], 'mod' => 0]);
                }
            });
            session()->flash('message', 'Modifiée avec succès.');
        }catch(\Illuminate\Database\QueryException $ex){
            session()->flash('error-message', "Erreur: ".$ex->getMessage());
        }


    }

    public function add($i)
    {
        $i = $this->lines_count + 1;
        $this->i = $i;
        array_push($this->inputs , $i);
    }

    public function remove($i)
    {
        //dd($this->articleId[$i]);
        $lineToRemove = DemandeAchatLine::where('article_id', $this->articleId[$i]);

        if ($lineToRemove->exists()) {
            $lineToRemove->delete();

        }
        //dd($this->inputs[$i]);
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

        $list_departements = Departement::all()->sortBy('departement');
        $list_depots = Depot::all()->sortBy('name');
        $list_sites = Site::all()->sortBy('name');
        return view('livewire.achat.edit-demande-achat', [ 'list_depots' => $list_depots, 'list_sites' => $list_sites, 'list_departements' => $list_departements, 'articles' => $this->articles, 'lines_count' => $this->lines_count]);
    }
}
