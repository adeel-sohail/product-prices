<?php

namespace App\Service;

use App\Repository\ProductRepository;

class MockApiService
{

    public function __construct(private readonly string $mockDataDir, private readonly ProductRepository $productRepository)
    {

    }

    public
    function getRawProductPrices(): array
    {
        return [
            'dataSource1' => json_decode(file_get_contents($this->mockDataDir . '/mockData1.json'), true),
            'dataSource2' => json_decode(file_get_contents($this->mockDataDir . '/mockData2.json'), true),
            'dataSource3' => json_decode(file_get_contents($this->mockDataDir . '/mockData3.json'), true),
        ];
    }

    public
    function getAggregatedProductPrices(): array
    {
        $dataSources = $this->getRawProductPrices();

        $dataSource1 = $dataSources['dataSource1'];
        $dataSource2 = $dataSources['dataSource2'];
        $dataSource3 = $dataSources['dataSource3'];

        $prices = [];
        $productId = $dataSource1['product_id'];
        foreach ($dataSource1['prices'] as $price) {
            $vendorName = $price['vendor'];
            $vendorPrices = $price['price'];
            $prices[$productId][$vendorName] = $vendorPrices;
        }

        $productId = $dataSource2['id'];
        foreach ($dataSource2['competitor_data'] as $price) {
            $vendorName = $price['name'];
            $vendorPrices = $price['amount'];
            $prices[$productId][$vendorName] = $vendorPrices;
        }

        $productId = $dataSource3['product'];
        foreach ($dataSource3['price_data'] as $vendor) {
            foreach ($vendor as $vendorName => $price) {
                $prices[$productId][$vendorName] = $price;
            }
        }

        return $prices;
    }

    public
    function getCheapestProductPrices(): array
    {
        $allProductPrices = $this->getAggregatedProductPrices();
        $cheapestProducts = [];
        foreach ($allProductPrices as $productId => $prices) {
            if (!empty($prices)) {
                $minPrice = min($prices);
                $minPriceVendorName = array_search($minPrice, $prices, true);
                $cheapestProducts[$productId] = [
                    'vendor' => $minPriceVendorName,
                    'price' => $minPrice,
                ];
            }

        }
        return $cheapestProducts;
    }

    public
    function saveProductPrices()
    {
        $products = $this->getCheapestProductPrices();
        $this->productRepository->saveProductPrices($products);
    }

}
