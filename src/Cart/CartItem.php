<?php

namespace App\Cart;

use App\Entity\Product;
use App\Entity\Supplement;

class CartItem{
    public $product;
    public $supplement;
    public $qty;

    public function __construct(Product $product, Supplement $supplement, int $qty)
    {
        $this->product = $product;
        $this->supplement = $supplement;
        $this->qty = $qty;
    }

    public function getTotal(): int{

        return $this->supplement->getPrice() * $this->qty + $this->product->getPrice();
    }

}