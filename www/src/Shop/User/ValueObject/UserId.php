<?php

namespace Shop\User\ValueObject;

use Assert\Assertion;

class UserId implements \JsonSerializable
{
    /**
     * @var string
     */
    private $userId;

    /**
     * ProductId constructor.
     *
     * @param string $userId
     */
    public function __construct(string $userId)
    {
        Assertion::uuid($userId);
        Assertion::string($userId);

        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->userId;
    }

    public function jsonSerialize()
    {
        return $this->userId;
    }
}