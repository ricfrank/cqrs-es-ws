<?php

namespace Shop\Product;

use Broadway\CommandHandling\CommandHandler;
use Broadway\Repository\RepositoryInterface;
use Shop\Product\Aggregate\Product;
use Shop\Product\Command\CreateProduct;

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
}