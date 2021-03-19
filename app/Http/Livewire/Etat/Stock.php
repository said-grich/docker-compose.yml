<?php

namespace App\Http\Livewire\Etat;

use App\Models\Article;
use App\Models\Depot;
use App\Models\Produit;
use App\Models\Site;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Stock extends Component
{

    use WithPagination;

    public $perPage=10;
    //public $sortField ="num_lot";
    public $sortAsc = true;
    public $siteId=[];
    public $depotId=[];
    public $articleId;
    public $numLot='';
    public $libelle;



    public function sortBy($field)
    {
        if($this->sortField === $field)
        {
            $this->sortAsc = ! $this->sortAsc;
        }

        else
        {
            $this->sortAsc=true;
        }

        $this->sortField = $field;
    }

    public function render()
    {


        $list_depots = Depot::all()->sortBy('name');
        $list_sites = Site::all()->sortBy('name');
        $list_articles = Article::all()->sortBy('libelle');
        //$list = Produit::all();

        /* $list = Produit::numLot($this->numLot)
            ->get();*/


        $list = DB::table('produits')
            ->select(DB::raw('produits.*, articles.id , articles.libelle, articles.marge, depots.name as depot_name, sites.name as site_name'))
            ->join('articles', function ($join) {
                $join->on('articles.id', '=', 'produits.article_id');
            })
            ->join('depots', function ($join) {
                $join->on('depots.id', '=', 'produits.depot_id');
            })
            ->join('sites', function ($join) {
                $join->on('sites.id', '=', 'produits.site_id');
            })
            ->where('produits.num_lot','like','%'.$this->numLot.'%')
            //->where('produits.site_id','like', '%'.$this->siteId.'%')

            //->whereIn('produits.depot_id','like', '%'. $this->depotId.'%')
            ->where('libelle','like', '%'.strtoupper($this->libelle).'%');
            //->get();

        $depots = $this->depotId;
        $sites = $this->siteId;

        $list->where(function ($query) use ($depots) {
                foreach ($depots as $keyword) {
                    $query->orWhere('produits.depot_id', 'like', $keyword);
                }
        });

        $list->where(function ($query) use ($sites) {
            foreach ($sites as $keyword) {
                $query->orWhere('produits.site_id', 'like', $keyword);
            }
        });
        $produits = $list->get();
        //dd($produits);

        $qteTotalArticle = DB::table('produits')
            ->select('article_id', DB::raw('SUM(qte) as total_sales'))
            ->groupBy('article_id')
            ->get();

        $qteTotalArticlesDepot = DB::table('produits')
            ->select('depot_id', DB::raw('SUM(qte) as total_sales'))
            ->groupBy('depot_id')
            ->get();



        /* $list =  Produit::select('produits.*')
            ->where('num_lot','like','%'.$this->numLot.'%')
            ->where('site_id','like', '%'.$this->siteId.'%')
            ->where('depot_id','like', '%'.$this->depotId.'%')
            ->where('article_id','like', '%'.$this->articleId.'%')
            ->paginate(10); */

        return view('livewire.etat.stock',['list'=> $produits,'list_depots' => $list_depots, 'list_sites' => $list_sites,'list_articles'=> $list_articles] );
    }


}
