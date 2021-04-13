<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Categorie;
use App\Models\Famille;
use App\Models\ModePreparation;
use App\Models\ModeVente;
use App\Models\Preparation;
use App\Models\PreparationType;
use App\Models\Produit;
use App\Models\ProduitPhoto;
use App\Models\ProduitTranche;
use App\Models\Tranche;
use App\Models\TranchesKgPc;
use App\Models\TranchesPoidsPc;
use App\Models\Unite;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Produits extends Component
{

    use WithFileUploads;

    public $list_categories;
    public $list_modes_preparation;
    public $list_tranches = [];
    public $list_modes_vente = [];
    public $list_preparations = [];
    public $list_familles = [];
    public $list_unite = [];
    public $code_comptable;
    public $code_analytique;

    public $mode_vente;
    public $mode_cuisine;
    public $list_cuisine = [];
    public $mode_nettoyage = [];
    public $list_nettoyage = [];
    public $mode_preparation;
    public $nom;
    public $famille;
    public $sous_categorie;
    public $unite;
    public $tranches=[];
    public $preparations = [];
    public $photo_principale;
    public $photos = [];
    public $active = false;
    public $type;
    public $minPoids;
    public $maxPoids;
    public $nomTranche;
    public $showPoids = false;
    public $showKgPiece = false;


    public function updatedModeVente($value){
        /* $mode_vente_nom = ModeVente::where('id',$value)->first()->nom;
        $this->list_tranches = Tranche::where('type',$mode_vente_nom)->get(); */
        $value == 1 ?  $this->list_tranches = Tranche::where('type',"Poids par pièce")->get() :  $this->list_tranches = Tranche::where('type',"Kg/Pièce")->get();

       if($value == 1) {
           $this->showPoids = true;
           $this->showKgPiece = false;
           //dd($this->minPoids );
       }else{
           $this->showKgPiece = true;
           $this->showPoids = false;
           //dd($this->showKgPiece );
       }
    }

    // public function updatedModePreparation($value){

    //     $mode = ModePreparation::find($value);
    //     $this->list_preparations = $mode->preparations;
    // }


    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);
    }


    public function mount()
    {
       // $this->list_categories = Categorie::all()->sortBy('nom');
        $modea = ModePreparation::find(1);
        $this->list_cuisine = $modea->preparations;
        $modeb = ModePreparation::find(2);
        $this->list_nettoyage = $modeb->preparations;
        $this->list_modes_vente = ModeVente::all()->sortBy('nom');
        $this->list_unite = Unite::all()->sortBy('nom');
        $this->list_familles = Famille::all()->sortBy('nom');
       /*  $p = Produit::where('id',1)->first(); */
        // dd($p->preparations->first()->preparation->nom);

    }

    public function createTranche()
    {
        $uniqueId = str_replace(".","",microtime(true)).rand(000,999);
        /* $this->type == 1 ?
            TranchesPoidsPc::create([
                'nom' => $this->minPoids." - ".$this->maxPoids,
                'min_poids' => $this->minPoids,
                'max_poids' => $this->maxPoids,
                'uid' => "PP".$uniqueId,
            ])
            :
            TranchesKgPc::create([
                'nom' => $this->nom,
                'uid' => "KP".$uniqueId,
            ]);
        */


        $this->type == 1 ? $this->nomTranche =  $this->minPoids." - ".$this->maxPoids : $this->nomTranche;
        Tranche::create([
            'nom' => $this->nomTranche,
            'type' => $this->type == 1 ? "Poids par pièce" : "Kg/Pièce",
            'min_poids' => $this->minPoids,
            'max_poids' => $this->maxPoids,
            'uid' => $this->type == 1 ? "PP".$uniqueId : "KP".$uniqueId,
        ]);
        $this->type  == 1 ?  $this->list_tranches = Tranche::where('type',"Poids par pièce")->get() :  $this->list_tranches = Tranche::where('type',"Kg/Pièce")->get();
        $this->reset(['nom','minPoids','maxPoids']);

    }

    public function createProduit()
    {
        //$this->validate();

        DB::transaction(function () {

            $photo_principale = $this->photo_principale->storeAs('public/produits/' . $this->nom . '/principale', date("Y-m-d") . "-" . $this->nom . "." . $this->photo_principale->guessExtension());

            $paths = [];
            foreach ($this->photos as $key => $photo) {
                $extension = $photo->getClientOriginalExtension();
                $filename  = "photo-$key-" . time() . '.' . $extension;
                $paths[$key] = $photo->storeAs("public/produits/$this->nom/photos", $filename);
            }

            $item = new Produit();
            $item->nom = $this->nom;
            //$item->sous_categorie_id = $this->sous_categorie;
            $item->mode_vente_id = $this->mode_vente;
            $item->mode_cuisine_id = 1;
            $item->mode_nettoyage_id = 2;
            $item->famille_id = $this->famille;
            $item->unite_id = $this->unite;
            $item->code_comptable = $this->code_comptable;
            $item->code_analytique = $this->code_analytique;
            $item->photo_principale = $photo_principale;
            //$item->photos = json_encode($paths, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES| JSON_FORCE_OBJECT);
            $item->active = $this->active;
            $item->save();

            foreach ($paths as $key => $value) {
                ProduitPhoto::create([
                    'produit_id' => $item->id,
                    'photo' => $paths[$key],
                ]);
            }

            PreparationType::create([
                'produit_id' => $item->id,
                'preparation_id' => $this->mode_cuisine,
            ]);

            foreach ($this->mode_nettoyage as $key => $value) {
                PreparationType::create([
                    'produit_id' => $item->id,
                    'preparation_id' => $this->mode_nettoyage[$key],
                ]);
            }

            foreach ($this->tranches as $key => $value) {
                ProduitTranche::create([
                    'produit_id' => $item->id,
                    'tranche_id' => $this->tranches[$key],
                ]);
            }
        });

        session()->flash('message', 'Produit "'. $this->nom. '" a été crée ');
        $this->reset(['nom', 'sous_categorie', 'mode_vente', 'mode_preparation', 'famille', 'unite', 'code_comptable', 'code_analytique', 'photos', 'photo_principale', 'active', 'tranches', 'preparations']);

        $this->emit('saved');
    }

    public function render()
    {
        //$this->renderData();
        return view('livewire.parametrage.produits');
    }
}
