<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $productId = null;

    #[ORM\Column(length: 30)]
    private ?string $vendorName = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 6)]
    private ?string $price = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $fetchedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): static
    {
        $this->productId = $productId;

        return $this;
    }

    public function getVendorName(): ?string
    {
        return $this->vendorName;
    }

    public function setVendorName(string $vendorName): static
    {
        $this->vendorName = $vendorName;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getFetchedAt(): ?\DateTimeImmutable
    {
        return $this->fetchedAt;
    }

    public function setFetchedAt(\DateTimeImmutable $fetchedAt): static
    {
        $this->fetchedAt = $fetchedAt;

        return $this;
    }
}
