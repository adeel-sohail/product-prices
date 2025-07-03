<?php

namespace App\Service;

use App\Entity\Product;
use App\Repository\ProductRepository;

class ProductService
{

    public function __construct(private readonly ProductRepository $productRepository)
    {
    }

    public function getAllProductsPrices(): array
    {
        return $this->productRepository->findAll();
    }

    public function getProductsPriceById(int $productId): ?Product
    {
        return $this->productRepository->findOneBy(['productId' => $productId]);
    }

}
