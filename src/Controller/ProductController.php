<?php

namespace App\Controller;

use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class ProductController extends AbstractController
{
    public function __construct(private readonly ProductService $productService)
    {
    }

    #[Route('/prices', name: 'app_get_products_prices', methods: ['GET'])]
    public function getProductsPrices(): JsonResponse
    {
        return $this->json($this->productService->getAllProductsPrices());
    }

    #[Route('/prices/{id}', name: 'app_get_products_price_by_id', methods: ['GET'])]
    public function getProductsPriceById(int $id): JsonResponse
    {
        return $this->json($this->productService->getProductsPriceById($id));
    }
}
