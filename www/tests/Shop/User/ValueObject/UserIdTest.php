<?php

namespace Tests\Shop\User\ValueObject;


use Shop\User\ValueObject\UserId;

class UserIdTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException Assert\InvalidArgumentException
     */
    public function it_throw_exception_if_invalid_id()
    {
        new UserId(1);
    }

    /**
     * @test
     */
    public function it_accept_valid_id()
    {
        $productId = new UserId('00000000-0000-0000-0000-000000000000');
        $this->assertEquals('00000000-0000-0000-0000-000000000000', (string)$productId);
    }
}
