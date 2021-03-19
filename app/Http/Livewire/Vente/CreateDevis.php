<?php

namespace App\Http\Livewire\Vente;

use App\Models\Client;
use App\Models\Article;
use App\Models\Devis;
use App\Models\Site;
use App\Models\DevisLine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class CreateDevis extends Component
{

    public $articles = [];
    public $libelle = [];
    public $tva = [];
    public $qte = [];
    public $prix = [];
    public $montant = [];
    public $remise = [];
    public $montanttva = [];
    public $code = [];
    public $articleId = [];
    public $linenumber;
    public $date;
    public $dateValidite;
    public $ref;
    public $clientId;
    public $siteId;
    public $delai;
    public $totalMts = [];
    public $totalTtcs = [];
    public $totalTvas = [];
    public $totalRemise;
    public $totalMt;
    public $totalTtc;
    public $totalTva;
    public $list_clients = [];


    protected $listeners = ['clientAdded' => 'renderClients'];

    protected $rules = [
        'date' => 'required',
        'dateValidite' => 'required',
        'ref' => 'required',
        'clientId' => 'required|min:1',
        'siteId' => 'required',
        'delai' => 'required',

    ];

    public $inputs = [];
    public $i = 0;

    public function renderClients()
    {
        $this->list_clients = Client::all()->sortBy('name');
    }

    public function updateData($i)
    {
        // dd($this);
        if (!isset($this->tva[$i])) {
            $this->tva[$i] = 0;
        }

        if (!isset($this->remise[$i])) {
            $this->remise[$i] = 0;
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

            $this->totalRemise = 0;
            for ($i = 0; $i < count($this->remise); $i++) {
                $this->totalRemise += $this->montant[$i] * ($this->remise[$i]/100);
            }

            $this->totalMt = 0;
            for ($i = 0; $i < count($this->montant); $i++) {
                $this->totalMt += $this->montant[$i];
            }

            $this->totalTva = 0;
            for ($i = 0; $i < count($this->montanttva); $i++) {
                $this->totalTva += $this->montanttva[$i];
            }

            $this->totalTtc = ($this->totalMt - $this->totalRemise) + $this->totalTva;
        }
    }

    public function add()
    {
        // dd($this->i);
        if ($this->i < count($this->montant)) {
            $this->i++;
            array_push($this->inputs, $this->i);
        }
    }

    public function remove($i)
    {
        array_splice($this->inputs, $i - 1, 1);
        $this->i--;
        array_splice($this->code, $i, 1);
        array_splice($this->articleId, $i, 1);
        array_splice($this->libelle, $i, 1);
        array_splice($this->tva, $i, 1);
        array_splice($this->qte, $i, 1);
        array_splice($this->prix, $i, 1);
        array_splice($this->remise, $i, 1);
        array_splice($this->montant, $i, 1);
        array_splice($this->montanttva, $i, 1);

    }

    public function showArticle($key)
    {
        $this->linenumber = $key;
    }

    public function getArticle($id, $code, $libelle, $tva)
    {
        $this->articleId[$this->linenumber] = $id;
        $this->code[$this->linenumber] = $code;
        $this->libelle[$this->linenumber] = $libelle;
        $this->tva[$this->linenumber] = $tva;
    }


    public function saveDevis()
    {
        $this->updateData(0);

        $this->validate();

        DB::transaction(function () {
            $item = new Devis();
            $item->date = $this->date;
            $item->date_validite = $this->dateValidite;
            $item->ref = $this->ref;
            $item->client_id = $this->clientId;
            $item->site_id = $this->siteId;
            $item->delai = $this->delai;
            $item->totalMt = $this->totalMt;
            $item->totalTva = $this->totalTva;
            $item->totalTtc = $this->totalTtc;
            $item->user_id = Auth::user()->id;
            $item->validation = 0;
            $item->save();


            foreach ($this->code as $key => $value) {

                DevisLine::create(['devis_ref' => $this->ref, 'article_id' => $this->articleId[$key], 'libelle_article' => $this->libelle[$key], 'tva' => $this->tva[$key], 'qte' => $this->qte[$key], 'prix' => $this->prix[$key], 'remise' => $this->remise[$key], 'montant' => $this->montant[$key]]);
            }
        });

        $this->articles = [];
        $this->libelle = [];
        $this->qte = [];
        $this->tva = [];
        $this->prix = [];
        $this->montant = [];
        $this->remise = [];
        $this->code = [];
        $this->articleId = [];
        $this->linenumber = null;
        $this->date = null;
        $this->dateValidite = null;
        $this->ref = null;
        $this->clientId = null;
        $this->siteId = null;
        $this->delai = null;
        $this->totalMt = null;
        $this->totalTtc = null;
        $this->totalTva = null;
        $this->totalMts = [];
        $this->totalTtcs = [];
        $this->totalTvas = [];

        $this->emit('saved');
    }

    public function render()
    {
        $this->renderClients();

        $list_sites = Site::all()->sortBy('name');
        if (isset($this->code[$this->linenumber]) && !empty($this->code)) {

            $this->articles = Article::where('code', 'like', '\\' . $this->code[$this->linenumber] . '%')->get();
        }

        //return view('livewire.vente.create-devis', ['list_clients' => $list_clients, 'list_sites' => $list_sites, 'articles' => $this->articles]);

        return view('livewire.vente.create-devis', ['list_sites' => $list_sites, 'articles' => $this->articles]);

    }
}
