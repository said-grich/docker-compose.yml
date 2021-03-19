<?php

namespace App\Http\Livewire;

use App\Models\Charge;
use App\Models\ChargeLine;
use App\Models\CompteComptable;
use App\Models\Site;
use COM;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class JournalAchat extends Component
{

    public $siteId;
    public $list;
    public $compteHt=[];
    public $compteTva=[];

    public function updatedSiteId($value)
    {

        /* $users = DB::table('charge_lines')
            ->whereBetween('date', ['2021-03-11', '2021-03-12'])
            ->get();
        dd($users); */

        $this->list = ChargeLine::join('charges', 'charge_lines.charge_ref', '=', 'charges.ref')
        ->where('charges.is_valid', true)
        ->where('charges.site_id', $value)
        ->groupBy('charge_lines.id','charge_lines.date', 'charges.montant_total_ttc')
        ->get(['charge_lines.*', 'charges.montant_total_ttc', 'charge_lines.date', 'charge_lines.id']);

        //dd($this->list);
        foreach($this->list as $key => $val){

            foreach($val->compte_comptable_ht_id as $k=>$v){
                $compte = CompteComptable::where('id', $v)->first();
                $this->compteHt[$k] = $compte->code;
            }
            foreach($val->compte_comptable_Tva_id as $k=>$v){
                $compte = CompteComptable::where('id', $v)->first();
                $this->compteTva[$k] = $compte->code."00".$val->ventilation[$k];
            }

        }

        //dd($this->compteHt);

        /* $this->list = Charge::where('site_id',$value)
        //->where('site_id',$value)
        ->first();
        dump($this->list);
        $line = ChargeLine::where('charge_ref',$this->list->ref)->get();
        $taux = [];
        foreach($line as $key=>$value){
            array_push($taux,array_keys($value->ventilation));


        }
        //dd($taux);
        dd($line); */
    }
    public function render()
    {

        //$this->list = BonAchat::all();


        //dd($this->list);
        $list_sites = Site::all()->sortBy('name');
        return view('livewire.journal-achat', ['list_sites'=>$list_sites]);
    }
}
