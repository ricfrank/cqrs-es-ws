<?php

namespace Shop\Product;

use Broadway\CommandHandling\CommandHandler;
use Broadway\Repository\RepositoryInterface;
use Shop\Product\Aggregate\Product;
use Shop\Product\Command\CreateProduct;
use Shop\Product\Command\UpdateProduct;

class ProductCommandHandler extends CommandHandler
{
    /**
     * @var RepositoryInterface
     */
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handleCreateProduct(CreateProduct $command)
    {
        $product = Product::create($command);

        $this->repository->save($product);
    }

    public function handleUpdateProduct(UpdateProduct $command)
    {
        /** @var Product $product */
        $product = $this->repository->load($command->getProductId());

        $product->update($command);

        $this->repository->save($product);
    }
}