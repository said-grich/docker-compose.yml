<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BonReception;
use App\Models\Lot;
use Livewire\WithPagination;

class ControleQualite extends Component
{

    use WithPagination;
    public $tranche_id = [];

    public $lot_id;
    public $lot_num;
    public $article;
    public $produit_id = [];
    public $mode_vente_id;
    public $mode_vente;
    public $nombre_piece;
    public $nom_tranche = [];
    public $test = [];
    // public $tranche_id = [];
    public $code = [];
    public $poids = [];
    public $isActive = false;

    public $list_fournisseurs = [];
    public $list_qualites = [];
    public $list_produits = [];
    public $liste_poids_pc = [];
    public $liste_kg_pc = [];
    public $list_tranches = [];
    public $list_depots = [];
    public $showNbrPiece = false;

    public $countInputs;
    public $i = 0;

    public $qte = [];
    public $prix_achat = [];
    public $montant = [];

    public $date_entree;
    public $ref_br;
    public $fournisseur;
    public $depot;
    public $qualite;
    public $br_lignes = [];



    public $sortBy = 'lot_num';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function updatedNombrePiece($value)
    {

        $this->countInputs = $value;
    }


    public function render()
    {


        // $items = Lot::query()
        //     //->where('ref', $archived_lots_ids)
        //     ->where('lot_num', 'ilike', '%' . $this->search . '%')
        //     ->orderBy($this->sortBy, $this->sortDirection)
        //     ->get()
        //     ->groupBy('lot_num');

            // foreach ($items as $key => $value) {
            // dd($value);
            // }

        $items = Lot::where('lot_num', 'ilike', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage)->groupBy(function ($data) {
            return $data->lot_num;
        });



        return view('livewire.controle-qualite', compact(['items']));
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

    public function show($id)
    {

        $lot = Lot::where('lot_num', $id)->first();
        dd($lot);
        $this->lot_num = $id;
        // $this->date_entree = $lot->date;
        // $this->fournisseur = $lot->fournisseur->nom;
        // $this->depot = $lot->depot->nom;
        // $this->qualite = $lot->qualite->nom;
        $this->br_lignes = $lot->bonReceptionLignes;
    }

    public function edit($id)
    {

        $item = Livreur::where('id', $id)->firstOrFail();
        $this->livreur_id = $item->id;
        $this->nom = $item->nom;
        $this->cin = $item->cin;
        $this->phone = $item->tel;
        $this->type = $item->type;
        $this->ville_id = $item->ville_id;
        $this->isActive = $item->active;
    }



    public function affecterPrix()
    {

        foreach ($this->produit_id as $key => $value) {
            $produit = Produit::where('id', $value)->first();
            if ($produit->modeVente->id == 1) {
                StockPoidsPc::where('code', $this->code[$key])
                    ->where('lot_num', $this->lot_num[$key])
                    ->where('br_num', $this->bon_reception_ref)
                    ->update([
                        'cr' => $this->cr[$key],
                        'prix_n' => $this->prix_vente_normal[$key],
                        'prix_f' => $this->prix_vente_fidele[$key],
                        'prix_p' => $this->prix_vente_business[$key],
                    ]);
            }/* else{
                dd($this->nom_tranche_kc_pc);
                StockPoidsPc::where('tranche_id', $this->nom_tranche_kc_pc[$key])
                    ->where('lot_num', $this->lot_num_kg_pc[$key])
                    ->where('br_num', $this->bon_reception_ref)
                    ->update([
                        'cr' => $this->cr_kg_pc[$key],
                        'prix_n' => $this->prix_vente_normal_kg_pc[$key],
                        'prix_f' => $this->prix_vente_fidele_kg_pc[$key],
                        'prix_p' => $this->prix_vente_business_kg_pc[$key],
                        ]);

            } */
            /* $flight = StockPoidsPc::updateOrCreate(
                ['departure' => 'Oakland', 'destination' => 'San Diego'],
                ['price' => 99, 'discounted' => 1]
            ); */
        }

        foreach ($this->produit_id_kg_pc as $key => $value) {
            StockPoidsPc::where('tranche_id', $this->nom_tranche_kc_pc[$key])
                ->where('lot_num', $this->lot_num_kg_pc[$key])
                ->where('br_num', $this->bon_reception_ref)
                ->update([
                    'cr' => $this->cr_kg_pc[$key],
                    'prix_n' => $this->prix_vente_normal_kg_pc[$key],
                    'prix_f' => $this->prix_vente_fidele_kg_pc[$key],
                    'prix_p' => $this->prix_vente_business_kg_pc[$key],
                ]);
        }
        /* $flight = StockPoidsPc::updateOrCreate(
                ['departure' => 'Oakland', 'destination' => 'San Diego'],
                ['price' => 99, 'discounted' => 1]
            ); */
    }


    public function deleteLivreur($id)
    {
        $this->render();
        $livreur = Livreur::findOrFail($id);
        $livreur->delete();
    }

    public function saved()
    {
        return $this->render();
    }


}
