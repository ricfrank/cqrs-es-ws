<?php

namespace Shop\Product\ReadModel;

use Broadway\ReadModel\ReadModelInterface;
use Broadway\Serializer\SerializableInterface;
use Shop\Product\ValueObject\ProductId;

/**
 * Class User
 *
 * @package Soisy\Domain\IdentityAccess\ReadModel
 */
class Product implements ReadModelInterface, SerializableInterface
{
    /**
     * @var ProductId
     */
    private $productId;

    /**
     * @var string
     */
    private $barcode;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $imageUrl;

    /**
     * @var string
     */
    private $brand;

    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;

    /**
     * @var \DateTimeImmutable
     */
    private $updatedAt;

    /**
     * @var int
     */
    private $size;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->productId;
    }

    /**
     * @return ProductId
     */
    public function getProductId(): ProductId
    {
        return $this->productId;
    }

    /**
     * @param ProductId $productId
     */
    public function setProductId(ProductId $productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeImmutable $createdAt
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getBarcode(): string
    {
        return $this->barcode;
    }

    /**
     * @param string $barcode
     */
    public function setBarcode(string $barcode)
    {
        $this->barcode = $barcode;
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
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        $product = new Product();

        $product->setProductId(new ProductId($data['productId']));
        $product->setBarcode($data['barcode']);
        $product->setName($data['name']);
        $product->setImageUrl($data['imageUrl']);
        $product->setBrand($data['brand']);
        $product->setCreatedAt(new \DateTimeImmutable($data['createdAt']));
        $product->setSize($data['size']);
        if (isset($data['updatedAt'])) {
            $product->setUpdatedAt(new \DateTimeImmutable($data['updatedAt']));
        }

        return $product;
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return [
            'productId' => (string)$this->productId,
            'barcode' => $this->barcode,
            'name' => $this->name,
            'size' => $this->size,
            'imageUrl' => $this->imageUrl,
            'brand' => $this->brand,
            'createdAt' => $this->createdAt->format('Y-m-d\TH:i:s.uP'),
            'updatedAt' => is_null($this->updatedAt) ? null : $this->updatedAt->format('Y-m-d\TH:i:s.uP')
        ];
    }

    /**
     * @param \DateTimeImmutable $updatedAt
     */
    public function setUpdatedAt(\DateTimeImmutable $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @param int $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }
}