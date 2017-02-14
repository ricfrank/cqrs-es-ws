<?php

namespace Shop\Product\ValueObject;

use Assert\Assertion;

class ProductId implements \JsonSerializable
{
    /**
     * @var string
     */
    private $productId;

    /**
     * ProductId constructor.
     *
     * @param string $productId
     */
    public function __construct(string $productId)
    {
        Assertion::uuid($productId);
        Assertion::string($productId);

        $this->productId = $productId;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->productId;
    }

    public function jsonSerialize()
    {
        return $this->productId;
    }
}