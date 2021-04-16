<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\ModeVente;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ListeModeVente extends Component
{
    use WithPagination;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public $modevente_id;
    public $nom;


    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        return $this->sortBy = $field;
    }
    public function edit($id){

        $item = ModeVente::where('id',$id)->firstOrFail();
        $this->modevente_id =$item->id;
        $this->nom =$item->nom;
    }

    public function editModeVente(){

        ModeVente::where('id', $this->modevente_id)
            ->update([
                'nom' => $this->nom,
            ]);

        session()->flash('message', 'Mode Vente "'.$this->nom.'" à été modifiée');
        $this->emit('saved');
    }
    public function deleteModeVente($id)
    {
        /* $this->render();
        $unite = ModeVente::findOrFail($id);
        $unite->delete(); */

        $this->render();
        $unite = ModeVente::findOrFail($id);
        DB::table("mode_ventes")->where('id', $id)->delete();
        $unite->delete();

        session()->flash('message', 'Catégorie "'.$this->nom.' à été supprimer');
       // return redirect()->to('/categories');
    }

    public function render()
    {
        $items = ModeVente::query()
        ->where('nom','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.parametrage.liste-mode-vente',[
            'items'=> $items
        ]);
    }
    public function saved()
    {
        return $this->render();
    }


}
