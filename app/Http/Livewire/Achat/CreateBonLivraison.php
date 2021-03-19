<?php

namespace App\Http\Livewire\Achat;

use App\Models\Client;
use App\Models\Commerciale;
use App\Models\Article;
use App\Models\BonAchat;
use App\Models\BonAchatLine;
use App\Models\BonLivraison;
use App\Models\BonLivraisonLine;
use App\Models\Depot;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Site;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateBonLivraison extends Component
{
    public $articles = [];
    public $libelle = [];
    public $articleInfo = [];
    public $produitId = [];
    public $numLot = [];
    public $tva = [];
    public $qte = [];
    public $qtestock = [];
    public $prix = [];
    public $montant = [];
    public $montanttva = [];
    public $code = [];
    public $articleId = [];
    public $linenumber;
    public $date;
    public $ref;
    public $clientId;
    public $commercialId;
    public $fournisseurId;

    public $siteId;
    public $depotId;

    public $clientSiteId;
    public $clientDepotId;
    // public $clientNumLot;

    public $interne = false;
    public $type;
    public $etat;
    public $totalMts = [];
    public $totalTtcs = [];
    public $totalTvas = [];
    public $totalMt;
    public $totalTtc;
    public $totalTva;
    public $list_pedots;

    protected $rules = [
        'date' => 'required',
        'ref' => 'required',
        'clientId' => 'required|min:1',
        'commercialId' => 'required',
        'siteId' => 'required|min:1',
        'depotId' => 'required|min:1',
        'type' => 'required',
        'etat' => 'required',


    ];

    public $inputs = [];
    public $i = 0;

    public function sitechange()
    {
        if (isset($this->siteId)) {
            $fournisseur = Fournisseur::where('site_id',$this->siteId)->first();

            if ($fournisseur->interne == 1) {
                $this->fournisseurId = $fournisseur->id;
            }
        }
    }

    public function clientchange()
    {
        if (isset($this->clientId)) {

            $client = Client::find($this->clientId);

            $this->interne = $client->interne == 1;
            $this->clientSiteId = $client->site_id;
        }
    }

    public function typechange()
    {
        if (isset($this->type)) {
            if ($this->type == 1) {
                $this->list_pedots = Depot::all()->sortBy('name');
            } else {
                $this->list_pedots = null;
            }
        }
    }

    public function numlotchange($index)
    {
        if (isset($this->numLot[$index])) {
            foreach ($this->articleInfo[$index] as $article) {
                // dd($atricle['num_lot'] == $this->numLot[$index]);
                if ($article['num_lot'] == $this->numLot[$index]) {
                    $this->qtestock[$index] = $article['qte'];
                    $this->produitId[$index] = $article['id'];
                }
            }
        }

    }

    public function updateData($i)
    {
        // dd($this);
        if (!isset($this->tva[$i])) {
            $this->tva[$i] = 0;
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
        array_splice($this->numLot, $i, 1);
        array_splice($this->montant, $i, 1);
        array_splice($this->montanttva, $i, 1);

        $this->updateData(0);
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

        $this->articleInfo[$this->linenumber] = Produit::where('article_id', '=', $id)
            ->where('depot_id', '=', $this->depotId)->get();

        // dd($this->articleInfo[$this->linenumber][0]->num_lot );
    }

    public function saveBonLivraison()
    {
        $this->validate();


        DB::transaction(function () {
            $item = new BonLivraison();

            $item->date = $this->date;
            $item->ref = $this->ref;
            $item->client_id = $this->clientId;
            $item->commercial_id = $this->commercialId;

            $item->site_id = $this->siteId;
            $item->depot_id = $this->depotId;

            if ($this->clientSiteId && $this->clientDepotId) {

                $item->client_site_id = $this->clientSiteId;
                $item->client_depot_id = $this->clientDepotId;
            }

            $item->type = $this->type;
            $item->etat = $this->etat;

            $item->totalMt = $this->totalMt;
            $item->totalTva = $this->totalTva;
            $item->totalTtc = $this->totalTtc;

            $item->user_id = Auth::user()->id;

            $item->save();


            if ($this->interne == 1) {

                $bonAchat = new BonAchat();
                $bonAchat->date = $this->date;
                $bonAchat->date_bl_fournisseur = $this->date;
                $bonAchat->ref = $this->ref;
                $bonAchat->num_lot = "1222";
                $bonAchat->site_id = $this->clientSiteId;
                $bonAchat->depot_id = $this->clientDepotId;
                $bonAchat->fournisseur_id = $this->fournisseurId;
                $bonAchat->user_id = Auth::user()->id;
                $bonAchat->total_ht = $this->totalMt;
                $bonAchat->total_tva = $this->totalTva;
                $bonAchat->total_ttc = $this->totalTtc;
                $bonAchat->save();
            }


            // dd($this);
            foreach ($this->code as $key => $value) {

                BonLivraisonLine::create(['bon_livraison_ref' => $this->ref, 'article_id' => $this->articleId[$key], 'libelle_article' => $this->libelle[$key], 'tva' => $this->tva[$key], 'qte' => $this->qte[$key], 'prix' => $this->prix[$key], 'montant' => $this->montant[$key]]);

                if ($this->interne == 1) {
                    BonAchatLine::create(['bon_achat_ref' => $this->ref, 'article_id' => $this->articleId[$key], 'libelle_article' => $this->libelle[$key], 'qte' => $this->qte[$key], 'prix_achat' => isset($this->prix[$key]), 'montant' => isset($this->montant[$key])]);

                    Produit::create(['num_lot' => $this->numLot[$key], 'depot_id' => $this->clientDepotId, 'site_id' => $this->clientSiteId, 'article_id' => $this->articleId[$key], 'qte' => $this->qte[$key], 'prix_achat' => isset($this->prix[$key])]);

                    Produit::find($this->produitId[$key])->update(['qte' => $this->qtestock[$key] - $this->qte[$key]]);
                }
            }

            $this->reset(['articles', 'libelle', 'qte', 'tva',  'prix', 'montant', 'montanttva', 'code', 'depotId',  'articleId', 'linenumber', 'date', 'ref', 'clientId', 'commercialId', 'siteId', 'type', 'etat', 'totalMt', 'totalTtc', 'totalTva']);
        });

        $this->emit('saved');
    }
    public function render()
    {
        $this->list_pedots = Depot::all()->sortBy('name');
        $list_clients = Client::all()->sortBy('name');
        $list_sites = Site::all()->sortBy('name');
        $liste_commercials = Commerciale::all()->sortBy('name');
        if (isset($this->code[$this->linenumber]) && !empty($this->code)) {
            $this->articles = Article::where('code', 'like', '\\' . $this->code[$this->linenumber] . '%')->get();
        }
        return view('livewire.achat.create-bon-livraison', ['list_clients' => $list_clients, 'liste_commercials' => $liste_commercials, 'list_sites' => $list_sites, 'articles' => $this->articles]);
    }
}
