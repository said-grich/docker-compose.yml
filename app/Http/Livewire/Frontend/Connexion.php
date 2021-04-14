<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class Connexion extends Component{
    public $form = [
        'email' => '',
        'tel' => '',
        'password' => '',
    ];

    protected $rules = [
        'form.email' => 'required|email',
        'form.password' => 'required',
    ];

    public function submit(){
        $this->validate();
        dd($this->form);
    }

    public function render(){
        return view('livewire.frontend.connexion')->layout('layouts.frontend.app');
    }
}
