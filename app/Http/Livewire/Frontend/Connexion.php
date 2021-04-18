<?php

namespace App\Http\Livewire\Frontend;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function mount(){
        if(Auth::user()){
            return redirect()->to('/');
        }
    }

    public function submit(){
        // dd(Session::all());
        $this->validate();

        // dd(sha1($this->form['password']));

        $check = User::select()->where('email', $this->form['email'])->get();

        if(count($check) === 1 && Hash::check($this->form['password'], $check[0]->password)){
            Auth::attempt($this->form);
            return redirect()->to('/');
        }else{
            session()->flash('warning-message', 'E-Mail ou mot de passe incorrect');
        }
        
    }

    public function render(){
        return view('livewire.frontend.connexion')->layout('layouts.frontend.app');
    }
}
