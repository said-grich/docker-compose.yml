<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Fournisseur;
use App\Models\FournisseurContact;
use Livewire\Component;
use Livewire\WithPagination;

class ListeFournisseurs extends Component
{
    use WithPagination;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public $fournisseur_id;
    public $nom;
    public $tel;

    public function render()
    {
        $fournisseur = Fournisseur::query()
        ->where('nom','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.Parametrage.liste-fournisseurs',[
            'fournisseur'=> $fournisseur
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

    public function edit($id){

        $item = Fournisseur::where('id',$id)->firstOrFail();
        $this->fournisseur_id =$item->id;
        $this->nom =$item->nom;
        $this->tel =$item->tel;

        /* $contacts = FournisseurContact::where( 'fournisseur_id',  $this->fournisseur_id)
                                     ->get();
                                     dd( $contacts); */
        /* foreach ($this->contact_tel as $key => $value) {
            FournisseurContact::create([
                'nom'=> $this->contact_nom[$key],
                'tel'=> $this->contact_tel[$key],
                'email'=> $this->contact_email[$key],
                'fonction'=> $this->contact_fonction[$key],
                'fournisseur_id'=> $item->id,
            ]);
        } */

    }

    public function editFournisseur(){

        Fournisseur::where('id', $this->fournisseur_id)
            ->update([
                'nom' => $this->nom,
                'tel' => $this->tel,
            ]);

        session()->flash('message', 'Fournisseur "'.$this->nom.'" à été modifiée');
        $this->emit('saved');
    }

    public function deleteFournisseur($id)
    {

        $fournisseur = Fournisseur::findOrFail($id);
        //DB::table("fournisseurs")->where('id', $id)->delete();

        $fournisseur->delete();
        session()->flash('message', 'Fournisseur "'.$fournisseur->nom.'" à été supprimé');

        //return redirect()->to('/familles');

    }

    public function saved()
    {
        $this->render();
    }



}
