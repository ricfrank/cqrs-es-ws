<?php

namespace Tests\Shop\Product\ValueObject;

use Shop\Product\ValueObject\ProductId;

class ProductIdTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException Assert\InvalidArgumentException
     */
    public function it_throw_exception_if_invalid_id()
    {
        new ProductId(1);
    }

    /**
     * @test
     */
    public function it_accept_valid_id()
    {
        $productId = new ProductId('00000000-0000-0000-0000-000000000000');
        $this->assertEquals('00000000-0000-0000-0000-000000000000', (string)$productId);
    }
}
