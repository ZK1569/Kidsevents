<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $price;

    #[ORM\Column(type: 'string', length: 255)]
    private $slug;

    #[ORM\Column(type: 'string', length: 255)]
    private $main_picture;

    #[ORM\Column(type: 'text')]
    private $short_description;

    #[ORM\Column(type: 'integer')]
    private $time;

    #[ORM\Column(type: 'integer')]
    private $age_min;

    #[ORM\Column(type: 'integer')]
    private $age_max;

    #[ORM\Column(type: 'integer')]
    private $min_kids;

    #[ORM\Column(type: 'integer')]
    private $max_kids;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: PurchaseItem::class)]
    private $purchaseItems;

    public function __construct()
    {
        $this->purchaseItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getMainPicture(): string|null|UploadedFile
    {
        return $this->main_picture;
    }

    public function setMainPicture(string|null|UploadedFile $main_picture): self
    {
        $this->main_picture = $main_picture;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function setShortDescription(string $short_description): self
    {
        $this->short_description = $short_description;

        return $this;
    }

    public function getTime(): ?int
    {
        return $this->time;
    }

    public function setTime(int $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getAgeMin(): ?int
    {
        return $this->age_min;
    }

    public function setAgeMin(int $age_min): self
    {
        $this->age_min = $age_min;

        return $this;
    }

    public function getAgeMax(): ?int
    {
        return $this->age_max;
    }

    public function setAgeMax(int $age_max): self
    {
        $this->age_max = $age_max;

        return $this;
    }

    public function getMinKids(): ?int
    {
        return $this->min_kids;
    }

    public function setMinKids(int $min_kids): self
    {
        $this->min_kids = $min_kids;

        return $this;
    }

    public function getMaxKids(): ?int
    {
        return $this->max_kids;
    }

    public function setMaxKids(int $max_kids): self
    {
        $this->max_kids = $max_kids;

        return $this;
    }

    /**
     * @return Collection<int, PurchaseItem>
     */
    public function getPurchaseItems(): Collection
    {
        return $this->purchaseItems;
    }

    public function addPurchaseItem(PurchaseItem $purchaseItem): self
    {
        if (!$this->purchaseItems->contains($purchaseItem)) {
            $this->purchaseItems[] = $purchaseItem;
            $purchaseItem->setProduct($this);
        }

        return $this;
    }

    public function removePurchaseItem(PurchaseItem $purchaseItem): self
    {
        if ($this->purchaseItems->removeElement($purchaseItem)) {
            // set the owning side to null (unless already changed)
            if ($purchaseItem->getProduct() === $this) {
                $purchaseItem->setProduct(null);
            }
        }

        return $this;
    }
}
