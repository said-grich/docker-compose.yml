<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Famille;
use App\Models\SousFamille;
use App\Models\Article;
use App\Models\Depot;
use App\Models\Unite;
use App\Models\Fournisseur;
use Livewire\Component;

class CreateArticle extends Component
{
    public $code;
    public $code_fournisseur;
    public $libelle;
    public $famille_id;
    public $sousFamilleId;
    public $marque;

    public $code_comptable;
    public $assujetti_tva;
    public $tva;
    public $qte_minimum;
    public $qte_securite;

    public $uniteAchatId;
    public $uniteVenteId;
    public $uniteAfficheeId;
    public $regle_sorties_stocks;

    public $fournisseurId;
    //public $activer;
    public $selection=[];


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



    protected $rules = [
        'code' => 'required|min:2',
        'code_fournisseur' => 'required|min:2',
        'libelle' => 'required',
        'famille_id' => 'required|min:1',
        'sousFamilleId' => 'required',
        'code_comptable' => 'required',
        'assujetti_tva' => 'required',

        'qte_minimum' => 'required',
        'qte_securite' => 'required',
        'uniteAchatId' => 'required',
        'uniteVenteId' => 'required',
        'uniteAfficheeId' => 'required',
        'fournisseurId' => 'required',
        //'activer' => 'required',

    ];


    public function createArticle()
    {
        //$this->validate();


        //$fournisseurs = implode($this->selection, '-');
        //dd( $this->selection);

        $item = new Article();
        $item->code = $this->code;
        $item->code_fournisseur = $this->code_fournisseur;
        $item->libelle = $this->libelle;
        $item->marque = $this->marque;
        $item->famille_id = $this->famille_id;
        $item->sous_famille_id = $this->sousFamilleId;

        $item->code_comptable = $this->code_comptable;
        $item->assujetti_tva = $this->assujetti_tva;
        $item->tva = $this->tva;

        $item->unite_achat_id = $this->uniteAchatId;
        $item->unite_vente_id = $this->uniteVenteId;
        $item->unite_affichee_id = $this->uniteAfficheeId;
        $item->regle_sorties_stocks = $this->regle_sorties_stocks;
        $item->qte_minimum = $this->qte_minimum;
        $item->qte_securite = $this->qte_securite;
        $item->fournisseur_id = $this->selection;


        $item->interdire_achat = $this->interdire_achat;
        $item->interdire_vente = $this->interdire_vente;
        $item->montage = $this->montage;
        $item->garantie_fournisseur = $this->garantie_fournisseur;
        $item->garantie_client = $this->garantie_client;
        $item->accepter_stock_negatif = $this->accepter_stock_negatif;
        $item->nature = $this->nature;
        $item->plafond_remise = $this->plafond_remise;
        $item->type = $this->type;
        $item->service = $this->service;
        $item->cache = $this->cache;
        $item->peremption = $this->peremption;
        $item->date_peremption = $this->datePeremption;
        $item->pmp = $this->pmp;
        $item->marge = $this->marge;
        $item->taux_assurance = $this->taux_assurance;
        $item->frais_possession = $this->frais_possession;
        //dd($item);



        //$item->fournisseur_id = $this->fournisseurId;


        //$item->activer = $this->activer;
        $item->save();

        $this->reset(['code', 'libelle','marque','famille_id','marge','sousFamilleId','code_comptable','assujetti_tva','tva','qte_minimum','qte_securite','uniteAchatId','uniteVenteId','fournisseurId','selection','code_fournisseur','uniteAfficheeId','interdire_achat','interdire_vente','garantie_fournisseur','garantie_client','accepter_stock_negatif','nature','type','service','cache','plafond_remise','peremption','datePeremption','pmp','taux_assurance','frais_possession']);

        $this->emit('saved');
    }

    public function render()
    {
        $list_fournisseurs = Fournisseur::all()->sortBy('name');
        $list_depots = Depot::all()->sortBy('name');
        $list_unites = Unite::all()->sortBy('name');
        $list_famille = Famille::all()->sortByDesc('created_at');
        $list_sous_familles = SousFamille::all()->sortBy('name');
        return view('livewire.Parametrage.create-article', [ 'list_fournisseurs' => $list_fournisseurs,'list_unites' => $list_unites,'list_familles' => $list_famille, 'list_depots' => $list_depots, 'list_sous_familles' => $list_sous_familles ]);
    }
}
