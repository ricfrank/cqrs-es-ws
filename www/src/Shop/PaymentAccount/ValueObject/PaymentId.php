<?php

namespace Shop\PaymentAccount\ValueObject;


use Assert\Assertion;

class PaymentId
{
    /**
     * @var string
     */
    private $paymentId;

    /**
     * ProductId constructor.
     *
     * @param string $paymentId
     */
    public function __construct(string $paymentId)
    {
        Assertion::uuid($paymentId);
        Assertion::string($paymentId);

        $this->paymentId = $paymentId;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->paymentId;
    }

    public function jsonSerialize()
    {
        return $this->paymentId;
    }
}