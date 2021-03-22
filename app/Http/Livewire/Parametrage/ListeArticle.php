<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Article;
use App\Models\Fournisseur;
use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\DB;

class ListeArticle extends Component
{
    public $sortBy = 'code';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];
    use WithPagination;


    public function render()
    {

        $fournisseurs = [];

        $article = Article::query()
        ->where('code','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);
        foreach($article as $l){
            foreach($l->fournisseur_id as $key => $value){
                $articleFournisseurs[$key] = DB::table('fournisseurs')
                ->where('id', $value)->get();
                //$fournisseurs[$key] = $articleFournisseurs;
                $l->fournisseurs =$articleFournisseurs;

            }
            $articleFournisseurs = array();
        }


        return view('livewire.Parametrage.liste-article', [ 'article' => $article , 'fournisseurs' => $fournisseurs]);
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
    public function deleteArticle($id)
    {

        $article = Article::findOrFail($id);
        DB::table("articles")->where('id', $id)->delete();
        $article->delete();



        return redirect()->to('/create-article');

    }



    public function saved()
    {
        $this->render();
    }

    public function getAllFourniseurs($id){
        DB::table('fournisseurs')
            ->where('id', $id)->get();
    }

}
