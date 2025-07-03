<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function saveProductPrices($products): void
    {

        foreach ($products as $productId => $productData) {

            $product = $this->findOneBy(['productId' => $productId]);

            if (!$product) {
                $product = new Product();
                $product->setProductId($productId);
            }
            $product->setPrice($productData['price']);
            $product->setVendorName($productData['vendor']);
            $product->setFetchedAt(new \DateTimeImmutable());
            $this->getEntityManager()->persist($product);
        }
        $this->getEntityManager()->flush();
    }

}
