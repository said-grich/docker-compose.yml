<?php

namespace App\Http\Livewire;

use App\Models\ReglementFournisseur;
use App\Models\Site;
use Livewire\Component;

class JournalBanque extends Component
{
    public $siteId;
    public $list;

    public function updatedSiteId($value)
    {
        $this->list =ReglementFournisseur::whereIn('mode_paiement_id',[ 2, 3])
        //->orWhere('mode_paiement_id',3)
        ->where('validation_paiement','Payé')
        ->where('site_id',$value)
        ->get();
        //dd($this->list);

    }
    public function render()
    {
        $list_sites = Site::all()->sortBy('name');
        return view('livewire.journal-banque', ['list_sites'=>$list_sites]);
    }
}
