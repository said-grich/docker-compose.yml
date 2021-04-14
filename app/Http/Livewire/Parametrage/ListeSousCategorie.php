<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Categorie;
use App\Models\SousCategorie;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use PhpParser\Node\Stmt\Break_;

class ListeSousCategorie extends Component
{
    use WithPagination;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 10 ;
    public $search = '';
    protected $listeners = ['saved'];

    public $list_categories;
    public $sous_categorie_name;
    public $sous_categorie_id;
    public $categorie_id;

    public function render()
    {
        $items = SousCategorie::query()
        ->where('nom','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.Parametrage.liste-sous-categorie',[
            'items'=> $items
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
    public function  mount(){
        $this->list_categories = Categorie::all();
    }
    public function edit($id){
        $item = SousCategorie::where('id',$id)->firstOrFail();

        $this->sous_categorie_id =$item->id;
        $this->sous_categorie_name =$item->nom;
        $this->categorie_id =$item->categorie_id;

    }

    public function editSousCategorie(){

        $souscategorie_nom = SousCategorie::all(['sous_categories.nom','sous_categories.categorie_id']);

        foreach ($souscategorie_nom as $key => $value) {
          if (( $souscategorie_nom[$key]->nom == $this->sous_categorie_name) && ($souscategorie_nom[$key]->categorie_id == $this->categorie_id )) {

               // dd( 'egaux',$souscategorie_nom[$key]->nom  ,$this->sous_categorie_name, $souscategorie_nom[$key]->categorie_id, $this->categorie_id);
               $this->egalite ="true";
          }elseif (( $souscategorie_nom[$key]->nom <> $this->sous_categorie_name) && ($souscategorie_nom[$key]->categorie_id <> $this->categorie_id )) {
            //dd( 'different',$souscategorie_nom[$key]->nom  ,$this->sous_categorie_name, $souscategorie_nom[$key]->categorie_id, $this->categorie_id);
            $this->egalite ="false";

            }

        }
        if ( $this->egalite == "false") {
                SousCategorie::where('id', $this->sous_categorie_id)
                ->update([
                    'nom' => $this->sous_categorie_name,
                    'categorie_id' => $this->categorie_id,

                ]);
             //   session()->flash('message', 'Livraison a éte crée');
            }
    }

    public function deleteSousCategorie($id)
    {
        $this->render();
        $sousCategorie = SousCategorie::findOrFail($id);
        DB::table("categories")->where('id', $id)->delete();
        $sousCategorie->delete();
    }

    public function saved()
    {
        return $this->render();
    }


}
