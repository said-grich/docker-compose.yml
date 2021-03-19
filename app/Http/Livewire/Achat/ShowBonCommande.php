<?php

namespace App\Http\Livewire\Achat;

use App\Models\BonCommandeLine;
use Livewire\Component;

class ShowBonCommande extends Component
{

    public $ida;
    public $articles=[];
    public $libelle=[];
    public $famille=[];
    public $qte_magasinier=[];
    public $qte_commandee=[];
    public $prix = [];
    public $code=[];
    public $date;
    public $ref;
    public $departementId;
    public $lines_count;
    public $articleId=[];

    public function mount()
    {

        $list = BonCommandeLine::where('bon_commande_ref', $this->ida)->get();
        $this->lines_count = count($list);
        $this->ref= $list[0]->bon_commande_ref;
        $this->date= $list[0]->bonCommande->date;
        $this->fournisseurId= $list[0]->bonCommande->fournisseur_id;
        $i = 1;
        foreach ($list as $value) {
            $this->articleId[$i] = $value->article->id;
            $this->code[$i] = $value->article->code;
            $this->libelle[$i] = $value->article->libelle;
            $this->famille[$i] = $value->article->famille->famille;
            $this->qte_magasinier[$i] = $value->qte_magasinier;
            $this->qte_commandee[$i] = $value->qte_a_commander;
            $this->prix[$i] = $value->prix;
            $i++;
        }
    }
    public function render()
    {
        return view('livewire.achat.show-bon-commande');
    }
}
