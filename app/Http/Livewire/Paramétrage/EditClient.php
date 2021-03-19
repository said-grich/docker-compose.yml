<?php

namespace App\Http\Livewire\Paramétrage;

use App\Models\Client;
use App\Models\ModePaiement;
use Livewire\Component;

class EditClient extends Component
{
    public $idclient;
    public $name;
    public $langue;
    public $industrie;
    public $date_inscription;
    public $statut;


    public $agent_nom;
    public $agent_prenom;
    public $genre_agent;
    public $tele_agent;
    public $email_agent;
    public $poste_agent;

    public $address_livraison;
    public $code_postal_livraison;
    public $ville_livraison;
    public $province_livraison;
    public $pays_livraison;

    public $address_facturation;
    public $code_postal_facturation;
    public $ville_facturation;
    public $province_facturation;
    public $pays_facturation;

    public $comment_nous_trouve;
    public $recommandateur;

    public $tele_professionnel;
    public $tele_portable;
    public $fax;
    public $email;
    public $site_internet;
    public $linkedin;

    public $devise;
    public $mode_paiement;
    public $capitale;
    public $main_oeuvre;
    public $taxe_utilisee;
    public $revenue_entreprise;
    public $montant_total;
    public $tags = [];

    public function mount()
    {

        $client = Client::findOrFail(request()->id);


        $this->idclient = $client->id;
        $this->name = $client->name;
        $this->langue = $client->langue;
        $this->industrie = $client->industrie;
        $this->date_inscription = $client->date_inscription;
        $this->statut = $client->statut;

        $this->agent_nom = $client->agent_nom;
        $this->agent_prenom = $client->agent_prenom;
        $this->genre_agent = $client->genre_agent;
        $this->tele_agent = $client->tele_agent;
        $this->email_agent = $client->email_agent;
        $this->poste_agent = $client->poste_agent;
        $this->entreprise_agent = $client->entreprise_agent;
        $this->date_naissance_agent = $client->date_naissance_agent;

        $this->address_livraison = $client->address_livraison;
        $this->code_postal_livraison = $client->code_postal_livraison;
        $this->ville_livraison = $client->ville_livraison;
        $this->province_livraison = $client->province_livraison;
        $this->pays_livraison = $client->pays_livraison;

        $this->address_facturation = $client->address_facturation;
        $this->code_postal_facturation = $client->code_postal_facturation;
        $this->ville_facturation = $client->ville_facturation;
        $this->province_facturation = $client->province_facturation;
        $this->pays_facturation = $client->pays_facturation;

        $this->comment_nous_trouve = $client->comment_nous_trouve;
        $this->recommandateur = $client->recommandateur;

        $this->tele_professionnel = $client->tele_professionnel;
        $this->tele_portable = $client->tele_portable;
        $this->fax = $client->fax;
        $this->email = $client->email;
        $this->site_internet = $client->site_internet;
        $this->linkedin = $client->linkedin;

        $this->devise = $client->devise;
        $this->mode_paiement = $client->mode_paiement;
        $this->capitale = $client->capitale;
        $this->main_oeuvre = $client->main_oeuvre;
        $this->taxe_utilisee = $client->taxe_utilisee;
        $this->revenue_entreprise = $client->revenue_entreprise;
        $this->montant_total = $client->montant_total;
        $this->tags = $client->tags;

    }



    protected $rules = [

        'name' => 'required|min:2',
        'langue' => 'required',
        'industrie' => 'required',
        'date_inscription' => 'required',

        'agent_nom' => 'required|min:2',
        'agent_prenom' => 'required|min:2',
        'genre_agent' => 'required',
        'email_agent' => 'required|email',
        'poste_agent' => 'required',

        'tele_professionnel' => 'required',
        'email' => 'required|email',

    ];

    public function updateClient()
    {


        $this->validate();

        $client = Client::findOrFail($this->idclient);

        $client->name = $this->name;
        $client->langue = $this->langue;
        $client->industrie = $this->industrie;
        $client->date_inscription = $this->date_inscription;
        $client->statut = $this->statut;


        $client->agent_nom = $this->agent_nom;
        $client->agent_prenom = $this->agent_prenom;
        $client->genre_agent = $this->genre_agent;
        $client->tele_agent = $this->tele_agent;
        $client->email_agent = $this->email_agent;
        $client->poste_agent = $this->poste_agent;

        $client->address_livraison = $this->address_livraison;
        $client->code_postal_livraison = $this->code_postal_livraison;
        $client->ville_livraison = $this->ville_livraison;
        $client->province_livraison = $this->province_livraison;
        $client->pays_livraison = $this->pays_livraison;

        $client->address_facturation = $this->address_facturation;
        $client->code_postal_facturation = $this->code_postal_facturation;
        $client->ville_facturation = $this->ville_facturation;
        $client->province_facturation = $this->province_facturation;
        $client->pays_facturation = $this->pays_facturation;

        $client->comment_nous_trouve = $this->comment_nous_trouve;
        $client->recommandateur = $this->recommandateur;

        $client->tele_professionnel = $this->tele_professionnel;
        $client->tele_portable = $this->tele_portable;
        $client->fax = $this->fax;
        $client->email = $this->email;
        $client->site_internet = $this->site_internet;
        $client->linkedin = $this->linkedin;

        $client->devise = $this->devise;
        $client->mode_paiement = $this->mode_paiement;
        $client->capitale = $this->capitale;
        $client->main_oeuvre = $this->main_oeuvre;
        $client->taxe_utilisee = $this->taxe_utilisee;
        $client->revenue_entreprise = $this->revenue_entreprise;
        $client->montant_total = $this->montant_total;
        $client->tags = $this->tags;

        $client->save();

        return redirect('/create-client');
    }

    public function render()
    {
        return view('livewire.paramétrage.edit-client', [ 'modespaiment' => ModePaiement::all()]);
    }
}
