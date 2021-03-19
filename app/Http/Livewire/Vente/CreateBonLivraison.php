<?php

namespace App\Http\Livewire\Vente;

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
use App\Models\User;
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
    public $qtemsg = [];
    public $qtestock = [];
    public $prix = [];
    public $siteIdProduit = [];
    public $depotIdProduit = [];
    public $blSites = [];
    public $blDepots = [];
    public $montant = [];
    public $montanttva = [];
    public $code = [];
    public $articleId = [];
    public $linenumber = -1;
    public $date;
    public $ref;

    public $clientId;
    public $client;
    public $commercialId;
    public $commercial;
    public $fournisseurId;

    public $sitesIds = [];
    public $depotsIds = [];

    public $clientSiteId;
    public $clientDepotId;

    public $interne = false;

    public $totalMts = [];
    public $totalTtcs = [];
    public $totalTvas = [];
    public $totalMt;
    public $totalTtc;
    public $totalTva;

    public $search;
    public $oldSearch;
    public $produits = [];
    public $listArticles = [];

    public $list_pedots;
    public $list_clients;
    public $list_commercials;

    protected $rules = [
        'date' => 'required',
        'ref' => 'required',
        'clientId' => 'required|min:1',
        'commercialId' => 'required',
    ];

    public function mount()
    {
        if (isset(auth()->user()->autoriser_autres_depots)) {
            $this->sitesIds = auth()->user()->sites_autorise;
            $this->depotsIds = array_merge(auth()->user()->autoriser_autres_depots, [auth()->user()->depot_id]);
        }
    }

    public function updatedSearch()
    {

        // $this->listArticles = Produit::whereIn('site_id',$this->sitesIds)->WhereIn('depot_id', $this->depotsIds)->get();
        // $this->listArticles = Article::where('code','ILIKE',strtolower($this->search.'%'))->orWhere('libelle','ILIKE',strtolower($this->search.'%'))->limit(5)->get();
        // dd($this->produitId);
        // dd( Produit::whereNotIn('id', $this->produitId)->get());

        // $this->listArticles = Article::where(
        //     function ($query) {
        //         $query->where('code', 'ILIKE', strtolower($this->search . '%'))
        //             ->orWhere('libelle', 'ILIKE', strtolower($this->search . '%'));
        //     }
        // )
        //     ->whereExists(function ($query) {
        //         $query->select('site_id')
        //             ->from('produits')
        //             ->whereColumn('produits.article_id', 'articles.id')
        //             ->whereIn('produits.depot_id', $this->depotsIds)
        //             ->whereIn('produits.site_id', $this->sitesIds);
        //     })
        //     ->with('produits')
        //     ->get();

        // dd($this->listArticles);
        // if ($this->oldSearch != $this->search) {

            auth()->user()->hasRole('admin') ?
                $this->listArticles = Produit::whereNotIn('id', $this->produitId)
                ->where(function ($query) {
                    $query->where(
                        function ($query) {
                            $query->select('code')
                                ->from('articles')
                                ->whereColumn('articles.id', 'produits.article_id')
                                ->limit(1);
                        },
                        'ILIKE',
                        strtolower($this->search . '%')
                    )
                        ->orWhere(
                            function ($query) {
                                $query->select('libelle')
                                    ->from('articles')
                                    ->whereColumn('articles.id', 'produits.article_id')
                                    ->limit(1);
                            },
                            'ILIKE',
                            strtolower($this->search . '%')
                        );
                })
                ->with('site')
                ->with('depot')
                ->with('article')
                ->limit(5)->get()
                :
                $this->listArticles = Produit::whereIn('site_id', $this->sitesIds)->whereIn('depot_id', $this->depotsIds)->whereNotIn('id', $this->produitId)
                ->where(function ($query) {
                    $query->where(
                        function ($query) {
                            $query->select('code')
                                ->from('articles')
                                ->whereColumn('articles.id', 'produits.article_id')
                                ->limit(1);
                        },
                        'ILIKE',
                        strtolower($this->search . '%')
                    )
                        ->orWhere(
                            function ($query) {
                                $query->select('libelle')
                                    ->from('articles')
                                    ->whereColumn('articles.id', 'produits.article_id')
                                    ->limit(1);
                            },
                            'ILIKE',
                            strtolower($this->search . '%')
                        );
                })
                ->with('site')
                ->with('depot')
                ->with('article')
                ->limit(5)->get();

            if ($this->search === '') $this->listArticles = [];

        //    $this->oldSearch = $this->search;
        // }else{
        //     dd($this->listArticles );
        //     $this->listArticles = collect($this->listArticles)->whereNotIn('id', $this->produitId)->sortBy('code');
            // dd($this->listArticles );
        // }
    }

    public function updatingQte($fields, $i)
    {
        // dd($this->qtestock[$i]>$fields);
        if ($this->qtestock[$i] > $fields) {
            $this->qtemsg[$i] = "max";
            return;
        };
        $this->qtemsg[$i] = null;
    }

    public function clientchange()
    {

        if (isset($this->clientId)) {
            if ($this->clientId !== '') {
                $client = Client::find($this->clientId);

                $this->interne = $client->interne == 1;
                $this->clientSiteId = $client->site_id;
                $this->list_pedots = Depot::all()->sortBy('name');
            }
        }
    }

    public function showCommercial()
    {
        $this->commercial != '' ?
            $this->list_commercials = Commerciale::where('name', 'ILIKE', strtolower($this->commercial . '%'))->orderBy('name')->limit(4)->get()
            : $this->list_commercials = [];
    }

    public function getCommercial($id, $name)
    {
        $this->commercialId = $id;
        $this->commercial = $name;
    }

    public function showClient()
    {
        // dd($this->client);
        // dd(Client::where('name', 'ILIKE',strtolower($this->client . '%'))->orderBy('name')->limit(4)->get());
        $this->client != '' ?
            $this->list_clients = Client::where('name', 'ILIKE', strtolower($this->client . '%'))->orderBy('name')->limit(4)->get()
            : $this->list_clients = [];
    }

    public function getClient($id, $name)
    {
        $this->clientId = $id;
        $this->client = $name;

        if (isset($this->clientId)) {
            if ($this->clientId !== '') {
                $client = Client::find($this->clientId);

                $this->interne = $client->interne == 1;
                $this->clientSiteId = $client->site_id;
                $this->list_pedots = Depot::all()->sortBy('name');
            }
        }
    }

    public function updateData($i)
    {
        if ($i == 0 && !isset($this->prix[$i]) && !isset($this->qte[$i])) {
            $this->totalMt = 0;
            $this->totalTtc = 0;
            $this->totalTva = 0;

            $this->totalMts = [];
            $this->totalTtcs = [];
            $this->totalTvas = [];
        }

        if (!isset($this->tva[$i])) {
            $this->tva[$i] = 0;
        }

        if (isset($this->prix[$i]) && isset($this->qte[$i])) {


            array_splice($this->montant, $i, 1, $this->prix[$i] > 0 ? $this->qte[$i] * $this->prix[$i] : $this->qte[$i] * 0);

            array_splice($this->montanttva, $i, 1, $this->tva[$i] > 0 ? $this->qte[$i] * ($this->prix[$i] * ($this->tva[$i] / 100)) : $this->tva[$i] * 0);

            $this->totalMts = [];
            $this->totalTtcs = [];
            $this->totalTvas = [];

            // dd($this);
            for ($i = 0; $i < count($this->tva); $i++) {

                if (array_key_exists(strval($this->tva[$i]), $this->totalTvas)) {
                    $this->totalTvas[strval($this->tva[$i])] += $this->montanttva[$i];

                    $this->totalMts[strval($this->tva[$i])] = $this->totalMts[strval($this->tva[$i])] + $this->montant[$i];
                    $this->totalTtcs[strval($this->tva[$i])] = $this->totalMts[strval($this->tva[$i])] + $this->totalTvas[strval($this->tva[$i])];
                } else {
                    // dd($this);
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

    public function add($i, $qte, $prix, $lot)
    {
        // dd($this->produits);
        $this->linenumber++;

        $this->articleId[$this->linenumber] = $this->listArticles[$i]->article->id;
        $this->code[$this->linenumber] = $this->listArticles[$i]->article->code;
        $this->libelle[$this->linenumber] = $this->listArticles[$i]->article->libelle;
        $this->tva[$this->linenumber] = $this->listArticles[$i]->article->tva;
        $this->qte[$this->linenumber] = $qte;
        $this->prix[$this->linenumber] = $prix;

        $this->qtestock[$this->linenumber] = $this->listArticles[$i]->qte;
        $this->produitId[$this->linenumber] = $this->listArticles[$i]->id;

        $this->numLot[$this->linenumber] = $lot;

        $this->siteIdProduit[$this->linenumber] = $this->listArticles[$i]->site_id;
        $this->depotIdProduit[$this->linenumber] = $this->listArticles[$i]->depot_id;

        if (!in_array($this->listArticles[$i]->site_id, $this->blSites)) {
            array_push($this->blSites, $this->listArticles[$i]->site_id);
        }

        if (!in_array($this->listArticles[$i]->depot_id, $this->blDepots)) {
            array_push($this->blDepots, $this->listArticles[$i]->depot_id);
        }


        $this->produits[$this->linenumber] = $this->listArticles[$i];

        $this->updateData($this->linenumber);

        $this->updatedSearch();
    }

    public function remove($i)
    {
        $this->linenumber--;

        array_splice($this->code, $i, 1);
        array_splice($this->articleId, $i, 1);
        array_splice($this->libelle, $i, 1);
        array_splice($this->tva, $i, 1);
        array_splice($this->qte, $i, 1);
        array_splice($this->qtemsg, $i, 1);
        array_splice($this->prix, $i, 1);
        array_splice($this->numLot, $i, 1);
        array_splice($this->montant, $i, 1);
        array_splice($this->montanttva, $i, 1);

        array_splice($this->qtestock, $i, 1);
        array_splice($this->produitId, $i, 1);

        array_splice($this->siteIdProduit, $i, 1);
        array_splice($this->depotIdProduit, $i, 1);

        array_splice($this->produits, $i, 1);
        // dd($this->produits);

        $this->updateData(0);
        $this->updatedSearch();
    }

    public function saveBonLivraison()
    {

        $this->validate();

        DB::transaction(function () {

            for ($i = 0; $i < count($this->blDepots); $i++) {
                //dump($this->produits);

                for ($j = 0; $j < count($this->blSites); $j++) {

                    $ps = collect($this->produits)->where('site_id', $this->blSites[$j])->where('depot_id', $this->blDepots[$i]);


                    if (count($ps) > 0) {
                        // dd($ps);
                        $item = new BonLivraison();

                        $item->date = $this->date;
                        $item->ref = $this->ref;
                        $item->client_id = $this->clientId;
                        $item->commercial_id = $this->commercialId;

                        $item->site_id = $this->blSites[$j];
                        $item->depot_id = $this->blDepots[$i];

                        //$item->type = 1;

                        if ($this->clientSiteId && $this->clientDepotId) {

                            $item->client_site_id = $this->clientSiteId;
                            $item->client_depot_id = $this->clientDepotId;
                        }

                        // $item->type = $this->type;

                        $item->totalMt = $this->totalMt;
                        $item->totalTva = $this->totalTva;
                        $item->totalTtc = $this->totalTtc;

                        $item->user_id = Auth::user()->id;
                        $item->validation = 0;

                        $item->save();

                        foreach ($ps as $produit) {
                            // dd($this->produitId);
                            $key = array_search($produit['id'], $this->produitId);

                            BonLivraisonLine::create(['bon_livraison_ref' => $this->ref, 'article_id' => $produit['article']['id'], 'libelle_article' => $produit['article']['libelle'], 'tva' => $produit['article']['tva'], 'qte' => $this->qte[$key], 'prix' => $this->prix[$key], 'montant' => $this->montant[$key]]);

                            Produit::find($produit['id'])->update(['qte' => $produit['qte'] - $this->qte[$key]]);
                        }
                    }
                }
            }

            if ($this->interne == 1) {
                for ($j = 0; $j < count($this->blSites); $j++) {

                    $ps = collect($this->produits)->where('site_id', $this->blSites[$j]);
                    //dd($ps);

                    if (count($ps) > 0) {

                        $fournisseur = Fournisseur::select('id')->where('site_id', $this->blSites[$j])->first();
                        //dd($this->blSites[$j]);

                        $bonAchat = new BonAchat();
                        $bonAchat->date = $this->date;
                        $bonAchat->date_bl_fournisseur = $this->date;
                        $bonAchat->ref = $this->ref;
                        $bonAchat->site_id = $this->clientSiteId;
                        $bonAchat->depot_id = $this->clientDepotId;
                        $bonAchat->fournisseur_id = 1;
                        $bonAchat->user_id = Auth::user()->id;
                        $bonAchat->total_ht = $this->totalMt;
                        $bonAchat->total_tva = $this->totalTva;
                        $bonAchat->total_ttc = $this->totalTtc;
                        $bonAchat->save();

                        foreach ($ps as $produit) {
                            $key = array_search($produit['id'], $this->produitId);
                            //dd($this->prix[$key]);
                            BonAchatLine::create(['bon_achat_ref' => $this->ref, 'article_id' => $produit['article']['id'], 'libelle_article' => $produit['article']['libelle'], 'num_lot' => $this->numLot[$key], 'qte' => $this->qte[$key], 'prix_achat' => $this->prix[$key] /* isset($this->prix[$key]) */, 'montant' => isset($this->montant[$key]),'taux_tva'=>$this->tva[$key],'montant_tva'=>($this->prix[$key]*(($this->tva[$key])/100))]);

                            Produit::create(['num_lot' => $this->numLot[$key], 'depot_id' => $this->clientDepotId, 'site_id' => $this->clientSiteId, 'article_id' => $this->articleId[$key], 'qte' => $this->qte[$key], 'prix_achat' => isset($this->prix[$key]), 'bon_reception_id' => $bonAchat->id]);

                            Produit::find($this->produitId[$key])->update(['qte' => $this->qtestock[$key] - $this->qte[$key]]);
                        }
                    }
                }
            }
        });

        $this->reset(['articles', 'listArticles', 'libelle', 'qte', 'tva',  'prix', 'montant', 'montanttva', 'code',  'articleId', 'linenumber', 'date', 'ref', 'produitId', 'search', 'clientId', 'commercialId', 'totalMt', 'totalTtc', 'totalTva']);

        $this->emit('saved');
    }

    public function render()
    {
        for ($i = 0; $i <= count($this->produits); $i++) {
            if (isset($this->produits[$i])) {
                if (is_array($this->produits[$i])) {
                    $this->produits[$i] = new Produit($this->produits[$i]);
                }
            };
            // dd($this->produits);
        }
        return view('livewire.vente.create-bon-livraison');
    }
}
