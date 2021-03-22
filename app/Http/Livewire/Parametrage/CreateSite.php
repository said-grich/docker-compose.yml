<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Client;
use App\Models\Fournisseur;
use App\Models\Site;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateSite extends Component
{

    public $code;
    public $name;
    public $adresse;
    public $ville;
    public $pays;

    protected $rules = [
        'code' => 'required|min:2',
        'name' => 'required',
        'adresse' => 'required',
        'ville' => 'required',
        'pays' => 'required',
    ];


    public function createSite()
    {
        //$this->validate();
     try{

            DB::transaction(function () {

                $item = new Site();
                $item->code = $this->code;
                $item->name = $this->name;
                $item->adresse = $this->adresse;
                $item->ville = $this->ville;
                $item->pays = $this->pays;
                $item->save();

                $client = new Client();
                $client->name = $this->name;
                $client->address_livraison = $this->adresse;
                $client->ville_livraison = $this->ville;
                $client->pays_livraison = $this->pays;
                $client->address_facturation = $this->adresse;
                $client->ville_facturation = $this->ville;
                $client->pays_facturation = $this->pays;
                $client->interne = true;
                $client->site_id = $item->id;
                $client->user_id = auth()->id();
                $client->tele_professionnel = '0123456789';
                $client->langue = 'langue';
                $client->date_inscription = date('Y-m-d');
                $client->industrie = 'industrie';
                $client->statut = 'active';
                $client->agent_nom = 'nom agent';
                $client->agent_prenom = 'prenom agent';
                $client->genre_agent = 'M';
                $client->email_agent = 'agent@gmail.com';
                $client->poste_agent = 'poste agent';
                $client->email = 'client@gmail.com';
                $client->save();

                $fournisseur = new Fournisseur();
                $fournisseur->name = $this->name;
                $fournisseur->adresse = $this->adresse;
                $fournisseur->ville = $this->ville;
                $fournisseur->pays = $this->pays;
                $fournisseur->phone = '0123456589';
                $fournisseur->ice = 123456789000057;
                $fournisseur->designation = 'Poissonnerie et commercialisation des produits de la mer';
                $fournisseur->idFiscal = 123456789000157;
                $fournisseur->telephone_fixe = '0523456589';
                $fournisseur->email = 'fournisseur@gmail.com';
                $fournisseur->mode_paiement_id = 2;
                $fournisseur->interne = true;
                $fournisseur->site_id = $item->id; 
                $fournisseur->save();


            });



        $this->reset(['code', 'name', 'adresse', 'ville', 'pays']);

        $this->emit('saved');

        session()->flash('message', "La bon commande a été crée.");

        } catch(\Illuminate\Database\QueryException $ex){
            session()->flash('error-message', "Erreur: ".$ex->getMessage());
        }

    }

    public function render()
    {
        return view('livewire.Parametrage.create-site');
    }
}
