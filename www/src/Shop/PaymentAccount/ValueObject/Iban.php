<?php

namespace Shop\PaymentAccount\ValueObject;

use Assert\Assertion;

/**
 * Class Iban.
 *
 * @package Soisy\Domain\PaymentAccount\ValueObject
 */
class Iban implements \JsonSerializable
{

    /**
     * @var
     */
    private $iban;

    /**
     * @param $iban
     */
    public function __construct($iban)
    {
        if ($iban != '') {
            $iban = mb_strtoupper($iban);

            Assertion::string($iban);
            Assertion::regex($iban, '/^(IT)([0-9]{2})([A-Z]{1})([0-9]{10})([A-Z0-9]{12})$/');
        }

        $this->iban = $iban;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return is_null($this->iban)?'':$this->iban;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize()
    {
        return $this->iban;
    }
}
