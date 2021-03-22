<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\ModePaiement;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeModePaiement extends Component
{
    use WithPagination;

    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {
        $modePaienment = ModePaiement::query()
        ->where('name','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.Parametrage.liste-mode-paiement',[
            'modePaienment'=> $modePaienment
        ]);
        /*$modePaiement = ModePaiement::all();
        $list = ModePaiement::all()->sortByDesc('created_at');
        return view('livewire.Parametrage.liste-mode-paiement', ['list' => $list, 'modePaiement' => $modePaiement]);*/
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

    public function deleteModePaiement($id)
    {

        $modePaiement = ModePaiement::findOrFail($id);
        DB::table("mode_paiements")->where('id', $id)->delete();
        $modePaiement->delete();



        return redirect()->to('/create-mode-paiement');

    }



    public function saved()
    {
        $this->render();
    }

}
