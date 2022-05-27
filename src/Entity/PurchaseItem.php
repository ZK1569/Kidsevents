<?php

namespace App\Entity;

use App\Repository\PurchaseItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PurchaseItemRepository::class)]
class PurchaseItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Supplement::class, inversedBy: 'purchaseItems')]
    #[ORM\JoinColumn(nullable: true)]
    private $supplement;

    #[ORM\ManyToOne(targetEntity: Purchase::class, inversedBy: 'purchaseItems')]
    #[ORM\JoinColumn(nullable: false)]
    private $purchase;

    #[ORM\OneToOne(targetEntity: Supplement::class, inversedBy: 'purchaseItems')]
    #[ORM\JoinColumn(nullable: true)]
    private $productName;

    #[ORM\Column(type: 'integer')]
    private $productPrice;

    #[ORM\Column(type: 'integer')]
    private $quantity;

    #[ORM\Column(type: 'integer')]
    private $total;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSupplement(): ?Supplement
    {
        return $this->supplement;
    }

    public function setSupplement(?Supplement $supplement): self
    {
        $this->supplement = $supplement;

        return $this;
    }

    public function getPurchase(): ?Purchase
    {
        return $this->purchase;
    }

    public function setPurchase(?Purchase $purchase): self
    {
        $this->purchase = $purchase;

        return $this;
    }

    public function getProductName(): ?Product
    {
        return $this->productName;
    }

    public function setProductName(?Product $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    public function getProductPrice(): ?int
    {
        return $this->productPrice;
    }

    public function setProductPrice(int $productPrice): self
    {
        $this->productPrice = $productPrice;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }
}
