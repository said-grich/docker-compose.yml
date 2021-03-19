<?php

namespace App\Http\Livewire\Achat;

use App\Models\Article;
use App\Models\DemandeAchat;
use App\Models\DemandeAchatLine;
use App\Models\Departement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ShowDemandeAchat extends Component
{

    public $ida;
    public $articles=[];
    public $libelle=[];
    public $famille=[];
    public $qte=[];
    public $code=[];
    public $date;
    public $ref;
    public $departementId;
    public $lines_count;
    public $articleId=[];


    public function mount($ida)
    {
        $list = DemandeAchatLine::where('demande_achat_ref', $this->ida)->get();
        $this->lines_count = count($list);
        $this->ref= $list[0]->demande_achat_ref;
        $this->date= $list[0]->demandeAchat->date;
        $this->departementId= $list[0]->demandeAchat->departement_id;
        $i = 1;
        foreach ($list as $value) {
            $this->articleId[$i] = $value->article->id;
            $this->code[$i] = $value->article->code;
            $this->libelle[$i] = $value->article->libelle;
            $this->famille[$i] = $value->article->famille->famille;
            $this->qte[$i] = $value->qte;
            $i++;
        }
    }

    public function render()
    {
        return view('livewire.achat.show-demande-achat');
    }
}
