<?php

namespace App\Controller;

use App\Service\MockApiService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/api/product-prices')]
class MockApiController extends AbstractController
{

    public function __construct(private readonly MockApiService $mockApiService, private readonly LoggerInterface $logger)
    {
    }

    #[Route('/raw', name: 'app_get_raw_product_price', methods: ['GET'])]
    public function getRawProductPrices(): JsonResponse
    {
        return $this->json($this->mockApiService->getRawProductPrices());
    }

    #[Route('/agg', name: 'app_get__agg_product_prices', methods: ['GET'])]
    public function getAggregatedProductPrices(): JsonResponse
    {
        return $this->json($this->mockApiService->getAggregatedProductPrices());
    }

    #[Route('/cheapest', name: 'app_get_cheapest_product_prices', methods: ['GET'])]
    public function getCheapestProductPrices(): JsonResponse
    {
        return $this->json($this->mockApiService->getCheapestProductPrices());
    }

    #[Route('/save', name: 'app_save_product_prices', methods: ['GET'])]
    public function saveProductPrices(): JsonResponse
    {
        try {
            $this->mockApiService->saveProductPrices();

            return $this->json([
                'status' => 'success',
                'message' => 'Products saved successfully.',
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return $this->json([
                'status' => 'error',
                'message' => 'An error occurred while saving products.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
