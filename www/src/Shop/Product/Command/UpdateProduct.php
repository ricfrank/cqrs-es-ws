<?php

namespace Shop\Product\Command;

use Shop\Product\ValueObject\ProductId;

class UpdateProduct
{
    /**
     * @var ProductId
     */
    private $productId;
    /**
     * @var int
     */
    private $size;

    /**
     * @var \DateTimeImmutable
     */
    private $updatedAt;

    /**
     * UpdateProduct constructor.
     *
     * @param ProductId          $productId
     * @param                    $size
     * @param \DateTimeImmutable $updatedAt
     */
    public function __construct(ProductId $productId, int $size, \DateTimeImmutable $updatedAt)
    {
        $this->productId = $productId;
        $this->updatedAt = $updatedAt;
        $this->size = $size;
    }

    /**
     * @return ProductId
     */
    public function getProductId(): ProductId
    {
        return $this->productId;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }
}