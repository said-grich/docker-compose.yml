<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Facades\Cart;
use Illuminate\Contracts\Session\Session as SessionSession;
use Session;

class Panier extends Component
{
    public $total = 0;

    public function removeFromCart($productId): void{
        // dd(Session::all());
        Cart::remove($productId);
        $this->cart = Cart::get();
        $this->emit('productRemoved');
    }

    public function clear(){
        Cart::clear();
        $this->emit('clearCart');
        $this->cart = Cart::get();
    }

    public function render(){
        return view('livewire.frontend.panier')->layout('layouts.frontend.app');
    }
}
