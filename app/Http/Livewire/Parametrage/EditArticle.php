<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Famille;
use App\Models\SousFamille;
use App\Models\Article;
use App\Models\Depot;
use App\Models\Unite;
use App\Models\Fournisseur;
use Livewire\Component;

class EditArticle extends Component
{
    public $code;
    public $code_fournisseur;
    public $libelle;
    public $marque;
    public $famille_id;
    public $sousFamilleId;
    public $fournisseurId;
    public $selection=[];

    public $code_comptable;
    public $assujetti_tva;
    public $tva;
    public $qte_minimum;

    public $uniteAchatId;
    public $uniteVenteId;
    public $uniteAfficheeId;
    public $regle_sorties_stocks;

    public $interdire_achat = false;
    public $interdire_vente = false;
    public $montage = false;
    public $garantie_fournisseur;
    public $garantie_client;
    public $accepter_stock_negatif = false;
    public $nature;
    public $plafond_remise;
    public $type;
    public $peremption = false;
    public $service = false;
    public $cache = false;
    public $datePeremption;
    public $pmp;
    public $marge;
    public $taux_assurance;
    public $pmfrais_possessionp;
    public $frais_possession;
    public $article;
    public $ida;

    protected $rules = [
        'code' => 'required|min:2',
        'code_fournisseur' => 'required|min:2',
        'libelle' => 'required',
        'famille_id' => 'required|min:1',
        'sousFamilleId' => 'required',
        'code_comptable' => 'required',
        'assujetti_tva' => 'required',

        'qte_minimum' => 'required',
        'uniteAchatId' => 'required',
        'uniteVenteId' => 'required',
        'uniteAfficheeId' => 'required',
        'fournisseurId' => 'required',

    ];

    public function mount()
    {
        $this->ida = request()->ida;
        $this->article = Article::findOrFail($this->ida);
        $this->code= $this->article->code;
        $this->code_fournisseur= $this->article->code_fournisseur;
        $this->libelle= $this->article->libelle;
        $this->marque= $this->article->marque;
        $this->famille_id= $this->article->famille_id;
        $this->sousFamilleId= $this->article->sous_famille_id;
        $this->selection= $this->article->fournisseur_id;

        $this->code_comptable= $this->article->code_comptable;
        $this->assujetti_tva= $this->article->assujetti_tva;
        $this->tva = $this->article->tva ;

        $this->qte_minimum= $this->article->qte_minimum;
        $this->uniteAchatId= $this->article->unite_achat_id;
        $this->uniteVenteId= $this->article->unite_vente_id;
        $this->uniteAfficheeId= $this->article->unite_affichee_id;
        $this->regle_sorties_stocks= $this->article->regle_sorties_stocks;

        $this->interdire_achat= $this->article->interdire_achat;
        $this->interdire_vente= $this->article->interdire_vente;
        $this->montage= $this->article->montage;
        $this->garantie_fournisseur= $this->article->garantie_fournisseur;
        $this->garantie_client= $this->article->garantie_client;
        $this->accepter_stock_negatif= $this->article->accepter_stock_negatif;
        $this->nature= $this->article->nature;
        $this->plafond_remise= $this->article->plafond_remise;
        $this->type= $this->article->type;
        $this->service= $this->article->service;
        $this->cache= $this->article->cache;
        $this->peremption= $this->article->peremption;
        $this->datePeremption= $this->article->date_peremption;
        $this->pmp= $this->article->pmp;
        $this->marge= $this->article->marge;
        $this->taux_assurance= $this->article->taux_assurance;
        $this->frais_possession= $this->article->frais_possession;
    }

    public function editArticle()
    {

            $this->article->code = $this->code;
            $this->article->code_fournisseur = $this->code_fournisseur;
            $this->article->libelle = $this->libelle;
            $this->article->marque = $this->marque;
            $this->article->famille_id = $this->famille_id;
            $this->article->sous_famille_id =$this->sousFamilleId;
            $this->article->fournisseur_id = $this->selection;

            $this->article->code_comptable = $this->code_comptable;
            $this->article->assujetti_tva = $this->assujetti_tva;
            $this->article->tva = $this->tva;

            $this->article->qte_minimum = $this->qte_minimum;
            $this->article->unite_achat_id = $this->uniteAchatId;
            $this->article->unite_vente_id = $this->uniteVenteId;
            $this->article->unite_affichee_id = $this->uniteAfficheeId;
            $this->article->regle_sorties_stocks = $this->regle_sorties_stocks;

            $this->article->interdire_achat = $this->interdire_achat;
            $this->article->interdire_vente = $this->interdire_vente;
            $this->article->montage = $this->montage;
            $this->article->garantie_fournisseur = $this->garantie_fournisseur;
            $this->article->garantie_client = $this->garantie_client;
            $this->article->accepter_stock_negatif = $this->accepter_stock_negatif;
            $this->article->nature = $this->nature;
            $this->article->plafond_remise = $this->plafond_remise;
            $this->article->type = $this->type;
            $this->article->service = $this->service;
            $this->article->cache = $this->cache;
            $this->article->peremption = $this->peremption;
            $this->article->date_peremption = $this->datePeremption;
            $this->article->pmp = $this->pmp;
            $this->article->marge = $this->marge;
            $this->article->taux_assurance = $this->taux_assurance;
            $this->article->frais_possession = $this->frais_possession;


            $this->article->save();

            return redirect()->to('/create-article');

    }

    public function render()
    {
        $list_fournisseurs = Fournisseur::all()->sortBy('name');
        $list_depots = Depot::all()->sortBy('name');
        $list_unites = Unite::all()->sortBy('name');
        $list_famille = Famille::all()->sortByDesc('created_at');
        $list_sous_familles = SousFamille::all()->sortBy('name');
        return view('livewire.Parametrage.edit-article', [ 'list_fournisseurs' => $list_fournisseurs,'list_unites' => $list_unites,'list_familles' => $list_famille, 'list_depots' => $list_depots, 'list_sous_familles' => $list_sous_familles ]);
    }
}
