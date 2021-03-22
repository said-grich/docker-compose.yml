<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Article;
use App\Models\Fournisseur;
use App\Models\ProductionOperation;
use App\Models\ProductionTransformation;
use App\Models\Site;
use Livewire\Component;


class CreateProductionTransformation extends Component
{

    public $date_reception;
    public $article_id;
    public $site_id;
    public $lotmp;
    public $fournisseur_id;
    public $qteinitial;
    public $qte_apres_transformation;
    public $nbheure_travail;
    public $CRR;
    public $debut_tache;
    public $fin_tache;
    public $productionoperation_id;

    protected $rules = [
          'date_reception'=>'required',
          'article_id'=>'required',
          'site_id'=>'required',
          'lotmp'=>'required',
          'fournisseur_id'=>'required',
          'qteinitial'=>'required',
          'qte_apres_transformation'=>'required',
          'nbheure_travail'=>'required',
          'CRR'=>'required',
          'debut_tache'=>'required',
          'fin_tache'=>'required',
          'productionoperation_id'=>'required',
    ];

    public function createProductionTransformation(){
        $this->validate();
        $item=new ProductionTransformation();
        $item->date_reception = $this->date_reception;
        $item->article_id = $this->article_id;
        $item->site_id = $this->site_id;
        $item->lotmp = $this->lotmp;
        $item->fournisseur_id = $this->fournisseur_id;
        $item->qteinitial = $this->qteinitial;
        $item->qte_apres_transformation = $this->qte_apres_transformation;
        $item->nbheure_travail = $this->nbheure_travail;
        $item->CRR = $this->CRR;
        $item->debut_tache = $this->debut_tache;
        $item->fin_tache = $this->fin_tache;
        $item->productionoperation = $this->productionoperation;

        $item->save();
        $this->reset(['date_reception','article_id','site_id','lotmp','fournisseur_id','qteinitial',
        'qte_apres_transformation','nbheure_travail','CRR','debut_tache','fin_tache','productionoperation']);

        $this->emit('saved');

    }
    public function render()

    {
        $list_sites = Site::all()->sortBy('name');
        $list_article = Article::all()->sortBy('name');
        $list_fournisseurs = Fournisseur::all()->sortBy('name');
        $list_operations = ProductionOperation::all()->sortBy('name');
        return view('livewire.Parametrage.create-production-transformation', [ 'list_sites' => $list_sites, 'list_article' => $list_article ,
        'list_fournisseurs' => $list_fournisseurs,'list_operations' => $list_operations
        ]);
    }
}
