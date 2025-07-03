<?php

namespace App\Service;

class MockDataService
{

    private string $mockDataDir;

    public function __construct(string $mockDataDir)
    {
        $this->mockDataDir = $mockDataDir;
    }

    public function getAllProductPrices(): array
    {
        return [
            'dataSource1' => json_decode(file_get_contents($this->mockDataDir . '/mockData1.json', true)),
            'dataSource2' => json_decode(file_get_contents($this->mockDataDir . '/mockData2.json', true)),
            'dataSource3' => json_decode(file_get_contents($this->mockDataDir . '/mockData3.json', true)),
        ];
    }

    public function getSortedProductPrices()
    {

    }
}
