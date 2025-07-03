<?php

namespace App\Controller;

use App\Service\MockApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;


#[Route(path: '/api')]
class MockApiController extends AbstractController
{
    private MockApiService $mockApiService;

    public function __construct(MockApiService $mockApiService)
    {
        $this->mockApiService = $mockApiService;
    }

    #[Route('/product-prices/raw', name: 'app_product_prices_raw', methods: ['GET'])]
    public function getRawProductPrices(): JsonResponse
    {
        return new JsonResponse(
            $this->mockApiService->getRawProductPrices()
        );
    }

    #[Route('/product-prices/agg', name: 'app_product_prices_agg', methods: ['GET'])]
    public function getAggregatedProductPrices(): JsonResponse
    {
        return new JsonResponse(
            $this->mockApiService->getAggregatedProductPrices()
        );
    }

    #[Route('/product-prices/cheapest', name: 'app_product_prices_cheapest', methods: ['GET'])]
    public function getCheapestProductPrices(): JsonResponse
    {
        return new JsonResponse(
            $this->mockApiService->getCheapestProductPrices()
        );
    }

    #[Route('/product-prices/save', name: 'save_product_prices', methods: ['GET'])]
    public function saveProductPrices(): void
    {
        $this->mockApiService->saveProductPrices();
    }
}
