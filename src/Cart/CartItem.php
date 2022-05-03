<?php

namespace App\Cart;

use App\Entity\Supplement;

class CartItem{
    public $supplement;
    public $qty;

    public function __construct(Supplement $supplement, int $qty)
    {
        $this->supplement = $supplement;
        $this->qty = $qty;
    }

    public function getTotal(): int{

        return $this->supplement->getPrice() * $this->qty;
    }

}