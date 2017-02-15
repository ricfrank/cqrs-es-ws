<?php

namespace Tests\Shop\PaymentAccount\ValueObject;

use Shop\PaymentAccount\ValueObject\Iban;

class IbanTest extends \PHPUnit_Framework_TestCase
{
    public function invalid_iban()
    {
        return [
            ['AD1200012030200359100100'],
            ['AT611904300234573201'],
        ];
    }

    /**
     * @test
     * @expectedException \Assert\InvalidArgumentException
     * @dataProvider invalid_iban
     */
    public function should_be_invalid()
    {
        new Iban('1234');
    }

    /**
     * @test
     */
    public function should_be_valid()
    {
        $this->assertEquals('', (string)(new Iban(null)));
        $this->assertEquals('', (string)(new Iban('')));
        $this->assertEquals('IT40S05428111010000AA123456', (string)(new Iban('IT40S05428111010000AA123456')));
    }
}
