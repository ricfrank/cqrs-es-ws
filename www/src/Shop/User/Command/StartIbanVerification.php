<?php

namespace Shop\User\Command;

use Shop\PaymentAccount\ValueObject\Iban;
use Shop\User\ValueObject\UserId;

/**
 * Class StartIbanVerification
 * @package Shop\User\Command
 */
class StartIbanVerification
{
    /**
     * @var UserId
     */
    private $userId;
    /**
     * @var Iban
     */
    private $iban;
    /**
     * @var \DateTimeImmutable
     */
    private $date;

    /**
     * StartIbanVerification constructor.
     *
     * @param UserId             $userId
     * @param Iban               $iban
     * @param \DateTimeImmutable $date
     */
    public function __construct(UserId $userId, Iban $iban, \DateTimeImmutable $date)
    {
        $this->userId = $userId;
        $this->iban = $iban;
        $this->date = $date;
    }

    /**
     * @return UserId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDate()
    {
        return $this->date;
    }
}
