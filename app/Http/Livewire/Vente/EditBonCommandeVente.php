<?php

namespace App\Http\Livewire\Vente;

use App\Models\Article;
use App\Models\BonCommandeVente;
use App\Models\BonCommandeVenteLine;
use App\Models\Client;
use App\Models\Commerciale;
use App\Models\Depot;
use App\Models\Site;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class EditBonCommandeVente extends Component
{
    use WithPagination;

    public $ida;
    public $articles = [];
    public $libelle = [];
    public $tva = [];
    public $qte = [];
    public $prix = [];
    public $montant = [];
    public $montanttva = [];
    public $code = [];
    public $linenumber;
    public $date;
    public $ref;
    public $clientId;
    public $commercialId;
    public $lines_count;
    public $articleId = [];
    public $siteId;
    public $depotId;
    public $modeEdit = false;
    public $totalMts = [];
    public $totalTtcs = [];
    public $totalTvas = [];
    public $totalMt;
    public $totalTtc;
    public $totalTva;


    public $i = 0;

    protected $rules = [
        'date' => 'required',
        'ref' => 'required',
        'clientId' => 'required|min:1',
        'commercialId' => 'required|min:1',
        'siteId' => 'required|min:1',

    ];

    public function mount()
    {

        $this->ida = request()->ida;

        $list = BonCommandeVenteLine::where('bon_commande_ref', $this->ida)->get();
        //dd( $list);

        $this->lines_count = count($list);
        $this->ref = $list[0]->bon_commande_ref;
        $this->date = $list[0]->BonCommandeVente->date;
        $this->clientId = $list[0]->BonCommandeVente->client_id;
        $this->commercialId = $list[0]->BonCommandeVente->commercial_id;
        $this->siteId = $list[0]->BonCommandeVente->site_id;
        $this->depotId = $list[0]->BonCommandeVente->depot_id;

        $this->totalMt = $list[0]->BonCommandeVente->totalMt;
        $this->totalTtc = $list[0]->BonCommandeVente->totalTtc;
        $this->totalTva = $list[0]->BonCommandeVente->totalTva;

        $i = 0;
        foreach ($list as $value) {
            $this->articleId[$i] = $value->article->id;
            $this->code[$i] = $value->article->code;
            $this->libelle[$i] = $value->article->libelle;
            $this->tva[$i] = $value->tva;
            $this->qte[$i] = $value->qte;
            $this->prix[$i] = $value->prix;
            $this->montant[$i] = $value->montant;
            array_splice($this->montanttva, $i, 1, $this->tva[$i] > 0 ? $this->qte[$i] * ($this->prix[$i] * ($this->tva[$i] / 100)) : $this->tva[$i] * 0);
            $i++;
        }

        $this->updateData(0);
    }

    public function editBonCommandeVente()
    {
        $this->validate();

        DB::transaction(function () {
            $item = BonCommandeVente::where('ref', $this->ref)->first();
            $item->date = $this->date;

            $item->ref = $this->ref;
            $item->client_id = $this->clientId;
            $item->commercial_id = $this->commercialId;
            $item->site_id = $this->siteId;
            $item->depot_id = $this->depotId;
            $item->totalMt = $this->totalMt;
            $item->totalTva = $this->totalTva;
            $item->totalTtc = $this->totalTtc;

            $item->save();


            BonCommandeVenteLine::where('bon_commande_ref', $this->ref)->delete();

            foreach ($this->code as $key => $value) {

                BonCommandeVenteLine::create(['bon_commande_ref' => $this->ref, 'article_id' => $this->articleId[$key], 'libelle_article' => $this->libelle[$key], 'qte' => $this->qte[$key], 'tva' => $this->tva[$key], 'prix' => $this->prix[$key], 'montant' => $this->montant[$key]]);
            }
        });
        return redirect()->route('create-bon-commande-vente');
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
        array_splice($this->prix, $i, 1);
        array_splice($this->montant, $i, 1);
        array_splice($this->montanttva, $i, 1);

        $this->updateData(0);

    }

    public function updateData($i)
    {
        if (!isset($this->tva[$i])) {
            $this->tva[$i] = 0;
        }

        if (isset($this->prix[$i]) && isset($this->qte[$i])) {


            // dd($this);
            array_splice($this->montant, $i, 1, $this->prix[$i] > 0 ? $this->qte[$i] * $this->prix[$i] : $this->qte[$i] * 0);

            array_splice($this->montanttva, $i, 1, $this->tva[$i] > 0 ? $this->qte[$i] * ($this->prix[$i] * ($this->tva[$i] / 100)) : $this->tva[$i] * 0);

            $this->totalMts = [];
            $this->totalTtcs = [];
            $this->totalTvas = [];

            for ($i = 0; $i < count($this->tva); $i++) {
                if (array_key_exists(strval($this->tva[$i]), $this->totalTvas)) {
                    $this->totalTvas[strval($this->tva[$i])] += $this->montanttva[$i];

                    $this->totalMts[strval($this->tva[$i])] = $this->totalMts[strval($this->tva[$i])] + $this->montant[$i];
                    $this->totalTtcs[strval($this->tva[$i])] = $this->totalMts[strval($this->tva[$i])] + $this->totalTvas[strval($this->tva[$i])];
                } else {
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

            $this->totalTtc = $this->totalMt + $this->totalTva;
        }
    }

    public function showArticle($key)
    {
        $this->modeEdit = true;
        $this->linenumber = $key;
    }

    public function getArticle($id, $code, $libelle, $tva)
    {

        $this->articleId[$this->linenumber] = $id;
        $this->code[$this->linenumber] = $code;
        $this->libelle[$this->linenumber] = $libelle;
        $this->tva[$this->linenumber] = $tva;
    }


    public function render()
    {
        if ($this->modeEdit === true && isset($this->code[$this->linenumber])) {
            $this->articles = Article::where('code', 'like', '\\' . $this->code[$this->linenumber] . '%')->get();
        }

        $list_clients = Client::all()->sortBy('NAME');
        $list_sites = Site::all()->sortBy('name');
        $list_depots = Depot::all()->sortBy('name');
        $liste_commercials = Commerciale::all()->sortBy('name');
        return view('livewire.vente.edit-bon-commande-vente', ['list_clients' => $list_clients, 'liste_commercials' => $liste_commercials, 'list_sites' => $list_sites, 'articles' => $this->articles, 'lines_count' => $this->lines_count, 'list_depots' => $list_depots]);
    }
}
