<?php

namespace App\Http\Livewire\Vente;

use App\Models\LivreurCommande;
use Livewire\Component;
use Livewire\WithPagination;

class Reglement extends Component
{

    use WithPagination;

    public $commande_ref;
    public $date;
    public $date_livraison;
    public $quartier;
    public $livreur;
    public $client;
    public $commande_lignes = [];
    public $categories = [];
    public $produits = [];
    public $montant_total;

    public $tel_livraison;
    public $contact_livraison;
    public $adresse_livraison;
    public $ville;
    public $ville_zone;
    public $ville_quartie_id;
    public $mode_paiement;
    public $mode_livraison_id;
    public $frais_livraison;
    public $etat = [];
    public $etat_commande;
    public $ref;



    public $sortBy = 'commande_id';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function valider($commande,$livreur){

        LivreurCommande::where('commande_id', $commande)->where('livreur_id', $livreur)->update([
            'valide' => true,
            ]);
    }


    /* public function show($ref)
    {
        $commande = Commande::where('ref', $ref)->firstOrFail();
        $this->commande_ref = $ref;
        $this->etat_commande = $commande->etat;
        $this->date = $commande->date;
        $this->client = $commande->client_id;
        $this->date_livraison = $commande->date_livraison;
        $this->quartier = $commande->ville_quartier_id;
        $this->livreur = Livreur::where('id', $commande->livreur_id)->first()->nom;
        $quartie =  VilleQuartier::where('id', $commande->ville_quartie_id)->first();
        $this->ville_quartie_id = $quartie->nom;
        $this->ville_zone = $quartie->zone->nom;
        $this->ville = $quartie->zone->ville->nom;
        $this->adresse_livraison = $commande->adresse_livraison;
        $this->contact_livraison = $commande->contact_livraison;
        $this->tel_livraison = $commande->tel_livraison;
        $this->mode_paiement = ModePaiement::where('id', $commande->mode_paiement_id)->first()->nom;
        $this->mode_livraison_id = ModeLivraison::where('id', $commande->mode_livraison_id)->first()->nom;
        $this->frais_livraison = $commande->frais_livraison;
        $this->montant_total = $commande->geMontantTotal();


        $this->commande_lignes = $commande->commandeLignes->groupBy(function ($commande_ligne) {
            return $commande_ligne->categorie_id;
        })->toArray();

        foreach ($this->commande_lignes as $categorie_id => $items) {

            $this->categories[$categorie_id] = Categorie::where('id', $categorie_id)->first()->nom;

            foreach ($items as $key => $value) {

                $this->produits[$categorie_id][$key] = Stock::where('id',$value['piece_id'])->first()->produit->nom;
            }
        }
    } */

    public function render()
    {

        $items = LivreurCommande::query()
            ->where('commande_id', 'ilike', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            //->get();
            ->paginate($this->perPage);
            //dd($items);

        return view('livewire.vente.reglement', [
            'items' => $items
        ]);
    }
    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        return $this->sortBy = $field;
    }


    public function saved()
    {
        $this->render();
    }

}
