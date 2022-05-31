<?php

namespace App\Cart;

use App\Entity\Product;

class CartProd{
    public $product;
    public $qty;

    public function __construct(Product $product, int $qty)
    {
        $this->product = $product;
        $this->qty = $qty;
    }
}