<?php

namespace Tests\Shop\Product\ValueObject;

use Broadway\ReadModel\InMemory\InMemoryRepository;
use Broadway\ReadModel\Projector;
use Broadway\ReadModel\Testing\ProjectorScenarioTestCase;
use Shop\Product\Event\ProductCreated;
use Shop\Product\Event\ProductUpdated;
use Shop\Product\Projector\ProductProjector;
use Shop\Product\ReadModel\Product;
use Shop\Product\ValueObject\ProductId;

class ProductProjectorTest extends ProjectorScenarioTestCase
{
    /**
     * @test
     */
    public function should_create_a_product()
    {
        $productCreated = new ProductCreated(
            new ProductId('00000000-0000-0000-0000-000000000321'),
            '5707055029608',
            'Nome prodotto: Scaaarpe',
            'http://static.politifact.com.s3.amazonaws.com/subjects/mugs/fake.png',
            'Brand prodotto: Super Scaaaarpe',
            new \DateTimeImmutable('2017-02-14')
        );

        $product = new Product();

        $product->setProductId($productCreated->getProductId());
        $product->setBarcode($productCreated->getBarcode());
        $product->setName($productCreated->getName());
        $product->setImageUrl($productCreated->getImageUrl());
        $product->setBrand($productCreated->getBrand());
        $product->setCreatedAt($productCreated->getCreatedAt());

        $this->scenario
            ->given([])
            ->when($productCreated)
            ->then([$product]);
    }

    /**
     * @test
     */
    public function should_update_a_product()
    {
        $productCreated = new ProductCreated(
            new ProductId('00000000-0000-0000-0000-000000000321'),
            '5707055029608',
            'Nome prodotto: Scaaarpe',
            'http://static.politifact.com.s3.amazonaws.com/subjects/mugs/fake.png',
            'Brand prodotto: Super Scaaaarpe',
            new \DateTimeImmutable('2017-02-14')
        );

        $productUpdated = new ProductUpdated(
            $productCreated->getProductId(),
            5,
            new \DateTimeImmutable('2014-02-15')
        );

        $product = new Product();

        $product->setProductId($productCreated->getProductId());
        $product->setBarcode($productCreated->getBarcode());
        $product->setName($productCreated->getName());
        $product->setImageUrl($productCreated->getImageUrl());
        $product->setBrand($productCreated->getBrand());
        $product->setCreatedAt($productCreated->getCreatedAt());
        $product->setUpdatedAt($productUpdated->getUpdatedAt());
        $product->setSize($productUpdated->getSize());

        $this->scenario
            ->given([$productCreated])
            ->when($productUpdated)
            ->then([$product]);
    }

    /**
     * @return Projector
     */
    protected function createProjector(InMemoryRepository $repository)
    {
        return new ProductProjector($repository);
    }
}
