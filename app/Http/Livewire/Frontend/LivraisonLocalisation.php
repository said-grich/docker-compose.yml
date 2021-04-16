<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Ville;
use App\Models\VilleZone;
use Livewire\Component;
use Session;

class LivraisonLocalisation extends Component
{
    public $villes;
    public $ville;
    public $zones;
    public $zone;

    public function mount(){
        $this->villes = Ville::select()->where('livraison', true)->get();
        $this->ville = Session::has('villeLivraison') ? Session::get('villeLivraison') : '';
        $this->zone = Session::has('zoneLivraison') ? Session::get('zoneLivraison') : '';
        $this->zones = !empty($this->ville) ? VilleZone::select()->where('ville_id', $this->ville)->get() : '';
    }

    public function updatedVille($value,$index){
        $this->zones = VilleZone::select()->where('ville_id', $value)->get();
    }

    public function saveZoneLivraison(){
        Session::put('villeLivraison', $this->ville);
        Session::put('zoneLivraison', $this->zone);

        $this->emit('zoneRefrish');
    }

    public function render()
    {
        return view('livewire.frontend.livraison-localisation');
    }
}
