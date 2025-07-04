<?php
namespace App\Tests\Service;

use App\Service\ProductService;
use App\Repository\ProductRepository;
use App\Entity\Product;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class ProductServiceTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testGetAllProductsPricesReturnsRepositoryResult()
    {
        $mockRepo = $this->createMock(ProductRepository::class);
        $product1 = $this->createMock(Product::class);
        $product2 = $this->createMock(Product::class);

        $mockRepo->expects($this->once())
            ->method('findAll')
            ->willReturn([$product1, $product2]);

        $service = new ProductService($mockRepo);

        $result = $service->getAllProductsPrices();

        $this->assertSame([$product1, $product2], $result);
    }
}
