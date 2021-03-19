<?php

namespace App\Http\Livewire;

use App\Models\ReglementFournisseur;
use App\Models\Site;
use Livewire\Component;

class JournalCaisse extends Component
{
    public $siteId;
    public $list;

    public function updatedSiteId($value)
    {
        $this->list = ReglementFournisseur::where('mode_paiement_id',1)
        ->where('site_id',$value)
        ->get();
        //dd($this->list);
    }

    public function render()
    {
        $list_sites = Site::all()->sortBy('name');
        //$list = ReglementFournisseur::where('mode_paiement_id',1)->get();
        //dd($list);
        return view('livewire.journal-caisse', ['list_sites'=>$list_sites]);
    }
}
