<?php

namespace App\Http\Livewire\Paramétrage;

use App\Models\ProductionParametreFixe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListProductionParametreFixe extends Component
{
    use WithPagination;

    public $sortBy = 'matiere';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];
    public $matiere;
    public $items;
    public $prix;
    public $ida;

    public function render()
    {
        $parametre = ProductionParametreFixe::query()
        ->where('matiere','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.paramétrage.list-production-parametre-fixe',[
            'parametre'=> $parametre
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
    public function deleteparametrefixe($id)
    {
        $this->render();
        $param = ProductionParametreFixe::findOrFail($id);
        $param->delete();

    }

    protected $rules = [

        'matiere' => 'required',
    ];

    public function edit($id){


        $parametre = ProductionParametreFixe::where('id',$id)->firstOrFail();
        $this->id = $id;
        $this->matiere = $parametre->matiere;
        $this->prix = $parametre->prix;
    }

    public function editparametrefixe(Request $request){


        $update = [

            'matiere'=>$this->matiere,
            'prix'=>$this->prix,

        ];

        ProductionParametreFixe::where('id',$request->id)->update($update);

        //$this->validation($parametre);
        /*dd(ProductionParametreFixe::where//('id',$this->id)->first());

        $parametre = ProductionParametreFixe::where('id',$this->id)
        //->update([
            'matiere'=>$this->matiere,
            'prix'=>$this->prix,
        ]);*/

        /*$parametre = ProductionParametreFixe::firstOrFail($this->id);
            $parametre->id = $this->matiere;
            $parametre->matiere = $this->matiere;
            $parametre->prix = $this->prix;
            $parametre->save();*/
    }


    public function saved()
    {
        return $this->render();
    }
}
