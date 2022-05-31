<?php

namespace App\Cart;

use App\Entity\Supplement;

class CartSup{
    public $supplement;
    public $qty;

    public function __construct(Supplement $supplement, int $qty)
    {
        $this->supplement = $supplement;
        $this->qty = $qty;
    }
}