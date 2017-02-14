<?php

namespace Tests\Shop\Product\ValueObject;

use Broadway\CommandHandling\CommandHandlerInterface;
use Broadway\CommandHandling\Testing\CommandHandlerScenarioTestCase;
use Broadway\EventHandling\EventBusInterface;
use Broadway\EventStore\EventStoreInterface;
use Shop\Product\Command\CreateProduct;
use Shop\Product\Command\UpdateProduct;
use Shop\Product\Event\ProductCreated;
use Shop\Product\Event\ProductUpdated;
use Shop\Product\ProductCommandHandler;
use Shop\Product\Repository;
use Shop\Product\ValueObject\ProductId;

class UpdateProductTest extends CommandHandlerScenarioTestCase
{
    /**
     * @test
     */
    public function should_update_a_product()
    {
        $productCreated = new CreateProduct(
            new ProductId('00000000-0000-0000-0000-000000000321'),
            '5707055029608',
            'Nome prodotto: Scaaarpe',
            'http://static.politifact.com.s3.amazonaws.com/subjects/mugs/fake.png',
            'Brand prodotto: Super Scaaaarpe',
            new \DateTimeImmutable('2017-02-14')
        );
        $updateProduct = new UpdateProduct(
            $productCreated->getProductId(),
            5,
            new \DateTimeImmutable('2014-02-15')
        );

        $this->scenario
            ->withAggregateId($productCreated->getProductId())
            ->given([
                new ProductCreated(
                    $productCreated->getProductId(),
                    $productCreated->getBarcode(),
                    $productCreated->getName(),
                    $productCreated->getImageurl(),
                    $productCreated->getBrand(),
                    $productCreated->getRegisteredAt()
                )
            ])
            ->when($updateProduct)
            ->then(
                [
                    new ProductUpdated(
                        $productCreated->getProductId(),
                        $updateProduct->getSize(),
                        $updateProduct->getUpdatedAt()
                    )
                ]
            );
    }

    /**
     * Create a command handler for the given scenario test case.
     *
     * @param EventStoreInterface $eventStore
     * @param EventBusInterface   $eventBus
     *
     * @return CommandHandlerInterface
     */
    protected function createCommandHandler(EventStoreInterface $eventStore, EventBusInterface $eventBus)
    {
        $repository = new Repository($eventStore, $eventBus);

        return new ProductCommandHandler($repository);
    }
}
