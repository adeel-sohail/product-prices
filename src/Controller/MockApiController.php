<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\MockDataService;


#[Route(path: '/api')]
class MockApiController extends AbstractController
{
    private MockDataService $mockDataService;

    public function __construct(MockDataService $mockDataService)
    {
        $this->mockDataService = $mockDataService;
    }

    #[Route('/all-product-prices', name: 'all-product-prices', methods: ['GET'])]
    public function getAllProductPrices(): JsonResponse
    {
        return new JsonResponse([
            $this->mockDataService->getAllProductPrices()
        ]);
    }

    #[Route('/sorted-product-prices', name: 'sorted-product-prices', methods: ['GET'])]
    public function getSortedProductPrices(): JsonResponse
    {
        return new JsonResponse([
            $this->mockDataService->getSortedProductPrices()
        ]);
    }
}
