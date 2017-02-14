<?php

namespace Shop\Product\Event;

use Broadway\Serializer\SerializableInterface;
use Shop\Product\ValueObject\ProductId;

class ProductCreated implements SerializableInterface
{
    private $productId;
    private $barcode;
    /**
     * @var string
     */
    private $name;
    private $imageUrl;
    private $brand;

    private $createdAt;

    /**
     * ProductCreated constructor.
     *
     * @param ProductId $productId
     * @param string $name
     * @param string $barcode
     * @param string $imageUrl
     * @param string $brand
     * @param \DateTimeImmutable $createdAt
     */
    public function __construct(
        ProductId $productId,
        string $barcode,
        string $name,
        string $imageUrl,
        string $brand,
        \DateTimeImmutable $createdAt
    ) {
        $this->productId = $productId;
        $this->barcode = $barcode;
        $this->name = $name;
        $this->imageUrl = $imageUrl;
        $this->brand = $brand;
        $this->createdAt = $createdAt;
    }

    /**
     * @return ProductId
     */
    public function getProductId(): ProductId
    {
        return $this->productId;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getName(): string
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
     * @param mixed $barcode
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     */
    public function setImageUrl(string $imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @param array $data
     *
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        return new self(
            new ProductId($data['productId']),
            $data['barcode'],
            $data['name'],
            $data['imageUrl'],
            $data['brand'],
            new \DateTimeImmutable($data['createdAt'])
        );
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return [
            'productId' => (string)$this->productId,
            'name'      => $this->name,
            'barcode'   => $this->barcode,
            'imageUrl'  => $this->imageUrl,
            'brand'     => $this->brand,
            'createdAt' => $this->createdAt->format('Y-m-d\TH:i:s.uP')
        ];
    }
}
