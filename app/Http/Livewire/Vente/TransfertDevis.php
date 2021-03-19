<?php

namespace App\Http\Livewire\Vente;

use App\Models\Article;
use App\Models\BonCommandeVente;
use App\Models\BonCommandeVenteLine;
use App\Models\Client;
use App\Models\Commerciale;
use App\Models\Depot;
use App\Models\Devis;
use App\Models\DevisLine;
use App\Models\Site;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TransfertDevis extends Component
{
    public $refDevis;
    public $refBonCommande;
    public $articles = [];
    public $libelle = [];
    public $code = [];
    public $articleId = [];
    public $tva = [];
    public $qte = [];
    public $prix = [];
    public $montant = [];
    public $montanttva = [];
    public $linenumber;
    public $date;
    public $ref;
    public $clientId;
    public $siteId;
    public $depotId;

    public $commercialId;
    public $modeEdit = false;
    public $lines_count;

    public $clients=[];
    public $name=[];

    public $totalMts = [];
    public $totalTtcs = [];
    public $totalTvas = [];
    public $totalRemise;
    public $remise;

    public $totalMt;
    public $totalTtc;
    public $totalTva;
    public $list_clients = [];
    public $i = 0;



    protected $rules = [
        'date' => 'required',
        'ref' => 'required',
        //'clientId' => 'required|min:1',
        'siteId' => 'required',
    ];

    public function mount()
    {
        $this->ref = request()->ref;

        $list = DevisLine::where('devis_ref', $this->ref)->get();
        // dd($list);
        $this->lines_count = count($list);
        $this->ref = $list[0]->devis_ref;
        $this->date = $list[0]->devis->date;
        $this->clientId = $list[0]->devis->client_id;
        $this->siteId = $list[0]->devis->site_id;

        $this->totalMt = $list[0]->devis->totalMt;
        $this->totalTtc = $list[0]->devis->totalTtc;
        $this->totalTva = $list[0]->devis->totalTva;

        $i = 0;

        foreach ($list as $value) {
            $this->articleId[$i] = $value->article->id;
            $this->code[$i] = $value->article->code;
            $this->libelle[$i] = $value->article->libelle;
            $this->tva[$i] = $value->article->tva;
            $this->qte[$i] = $value->qte;
            $this->prix[$i] = $value->prix;
            $this->remise[$i] = $value->remise;
            $this->montant[$i] = $value->montant;
            array_splice($this->montanttva, $i, 1, $this->tva[$i] > 0 ? $this->qte[$i] * ($this->prix[$i] * ($this->tva[$i] / 100)) : $this->tva[$i] * 0);
            $i++;
        }
        $this->updateData(0);
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
        // dd($this);

        if (!isset($this->tva[$i])) {
            $this->tva[$i] = 0;
        }

        if (!isset($this->remise[$i])) {
            $this->remise[$i] = 0;
        }

        if (isset($this->prix[$i]) && isset($this->qte[$i])) {

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

    public function transfertDevis()
    {
        // dd($this);
        $this->updateData(0);

        $this->validate();


        DB::transaction(function () {
            $item = new BonCommandeVente();
            $item->date = $this->date;
            $item->ref = $this->refBonCommande;
            $item->client_id = $this->clientId;
            $item->commercial_id = $this->commercialId;
            $item->site_id = $this->siteId;
            $item->depot_id = $this->depotId;
            $item->user_id = Auth::user()->id;
            $item->validation = 0;
            $item->totalMt = $this->totalMt;
            $item->totalTtc = $this->totalTtc;
            $item->totalTva = $this->totalTva;

            $item->save();

            Devis::where('ref', $this->ref)->update(['validation' => 1]);
            //DevisLine::where('devis_ref', $this->ref)->update(['mod' => 1]);
            //DevisLine::where('devis_ref', $this->ref)->delete();

            foreach ($this->code as $key => $value) {

            BonCommandeVenteLine::create(['bon_commande_ref' => $this->refBonCommande, 'article_id' => $this->articleId[$key], 'libelle_article' => $this->libelle[$key], 'tva' => $this->tva[$key], 'qte' => $this->qte[$key], 'prix' => $this->prix[$key], 'montant' => $this->montant[$key]]);
            }
        });

        return redirect()->route('create-bon-commande-vente');
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
        $liste_commercials = Commerciale::all()->sortBy('name');
        $list_sites = Site::all()->sortBy('name');
        $list_depots = Depot::all()->sortBy('name');
        return view('livewire.vente.transfert-devis', ['list_clients' => $list_clients, 'list_sites' => $list_sites, 'articles' => $this->articles, 'lines_count' => $this->lines_count, 'list_depots' => $list_depots, 'liste_commercials' => $liste_commercials]);
    }
}
