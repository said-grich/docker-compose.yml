<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Produit;
use Livewire\Component;
use App\Facades\Cart;

class NavBar extends Component
{
    public $cartTotal = 0;

    protected $listeners = [
        'productAdded' => 'updateCartTotal',
        'productRemoved' => 'updateCartTotal',
        'clearCart' => 'updateCartTotal'
    ];

    public function mount()
    {
        $this->cartTotal = count(Cart::get()['products']);
    }

    public function updateCartTotal()
    {
        $this->cartTotal = count(Cart::get()['products']);
        dump($this->cartTotal);
        request()->session()->put('cartTotal', $this->cartTotal);
    }

    public function render()
    {
        return view('livewire.frontend.nav-bar');
    }
}