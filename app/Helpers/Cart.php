<?php


namespace App\Helpers;

use App\Models\Stock;
use Session;

class Cart
{
    public $test;
    public function __construct()
    {
        if($this->get() === null)
            $this->set($this->empty());
    }

    public function add(Stock $product): void
    {
        $cart = $this->get();
        // $cartProductsIds = array_column($cart['product-'.$product->id], 'id');
        // $product->amount = !empty($product->amount) ? $product->amount : 1;

        // if (in_array($product->id, $cartProductsIds)) {
        //     $cart['product-'.$product->id] = $this->productCartIncrement($product->id, $cart['product-'.$product->id]);
        //     $this->set($cart);
        //     return;
        // }
        foreach(Session::get($product->produit_id.'-'.$product->tranche_id) as $item){
            if($item['id'] == $product->id){
                array_push($cart['products'], array('pcs-'.$product->id => [$product, 'preparations' => $item[0]['preparations']]));
            }
        }

        // dd($cart);

        $this->set($cart);
    }

    public function remove($productId): void
    {
        $cart = $this->get();
        // $this->test = array_search($productId, $cart['products']);
        // dd($this->test);
        // if ($this->test !== false) {
        //     unset($cart['products'][$productId]);
        // }
        unset($cart['products'][$productId]);
        // array_splice($cart['products'], array_search($productId, array_column($cart['products'], $productId)), 1);
        $this->set($cart);
    }

    public function clear(): void
    {
        $this->set($this->empty());
    }

    public function empty(): array
    {
        return [
            'products' => [],
        ];
    }

    public function get(): ?array
    {
        return request()->session()->get('cart');
    }

    private function set($cart): void
    {
        request()->session()->put('cart', $cart);
    }

    // private function productCartIncrement($productId, $cartItems)
    // {
    //     $amount = 1;
    //     $cartItems = array_map(function ($item) use ($productId, $amount) {
    //         if ($productId == $item['id']) {
    //             $item['amount'] += $amount;
    //             $item['price'] += $item['price'];
    //         }

    //         return $item;
    //     }, $cartItems);

    //     return $cartItems;
    // }
}
