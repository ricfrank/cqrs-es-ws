<?php

namespace Shop\Product\Command;

use Shop\Product\ValueObject\ProductId;

class CreateProduct
{
    /**
     * @var ProductId
     */
    private $productId;
    private $barcode;
    private $name;
    private $imageUrl;
    private $brand;

    /**
     * @var \DateTimeImmutable
     */
    private $registeredAt;

    public function __construct(ProductId $productId, $barcode, $name, $imageUrl, $brand, \DateTimeImmutable $registeredAt)
    {
        $this->productId = $productId;
        $this->barcode = $barcode;
        $this->name = $name;
        $this->imageUrl = $imageUrl;
        $this->brand = $brand;
        $this->registeredAt = $registeredAt;
    }

    /**
     * @return ProductId
     */
    public function getProductId(): ProductId
    {
        return $this->productId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * @param string $barcode
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return mixed
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param mixed $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getRegisteredAt(): \DateTimeImmutable
    {
        return $this->registeredAt;
    }
}