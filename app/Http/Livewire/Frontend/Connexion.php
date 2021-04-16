<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Session;

class Connexion extends Component{
    public $form = [
        'email' => '',
        'password' => '',
    ];

    protected $rules = [
        'form.email' => 'required',
        'form.password' => 'required',
    ];

    public function submit(){
        // dd(Session::all());
        $this->validate();

        // dd(sha1($this->form['password']));

        $check = Client::select()->where('email', $this->form['email'])->where('password', sha1($this->form['password']))->get();

        if(count($check) === 1){
            Auth::guard('client')->attempt($this->form);
            return redirect()->to('/');
        }else{
            session()->flash('warning-message', 'E-Mail ou mot de passe incorrect');
        }
        
    }

    public function render(){
        return view('livewire.frontend.connexion')->layout('layouts.frontend.app');
    }
}
