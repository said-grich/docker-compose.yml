<?php

namespace App\Http\Livewire\Vente;

use App\Models\Commande;
use App\Models\Livreur;
use App\Models\LivreurCommande;
use App\Models\ModePaiement;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Reglement extends Component
{

    use WithPagination;

    public $livreur_id;
    public $commande_id;
    public $commande_ref;
    public $mode_paiement = [];
    public $mode_paiement_id;


    public $sortBy = 'commande_id';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function mount(){
        $this->mode_paiement = ModePaiement::all()->sortBy('nom');
    }


    public function valider($commande_id,$livreur_id){
        $this->livreur_id = $livreur_id;
        $this->commande_id = $commande_id;
        $commande = Commande::find($this->commande_id);
        $this->commande_ref = $commande->ref;
    }

    public function saveReglement(){
        $commande = Commande::find($this->commande_id);
        $this->commande_ref = $commande->ref;

        DB::transaction(function () {
            $montant_commande = Commande::find($this->commande_id)->total;

            LivreurCommande::where('commande_id', $this->commande_id)->where('livreur_id', $this->livreur_id)->update([
                'mode_paiement_id' => $this->mode_paiement_id,
                'valide' => true,
            ]);

            Livreur::find($this->livreur_id)->update(['solde' =>  DB::raw('solde - ' .$montant_commande)]);

            session()->flash('message', 'Commande N° "' . $this->commande_ref . '" a été réglée');
            $this->reset(['mode_paiement_id']);
        });
    }




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
