<?php

namespace Shop\User\Event;


use Broadway\Serializer\SerializableInterface;
use Shop\PaymentAccount\ValueObject\Iban;
use Shop\User\ValueObject\UserId;

/**
 * Class IbanVerified
 * @package Shop\User\Event
 */
class IbanVerified implements SerializableInterface
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
     * IbanVerified constructor.
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
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return Iban
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     * @param array $data
     *
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        return new self(
            new UserId($data['userId']),
            new Iban($data['iban']),
            new \DateTimeImmutable($data['date'])
        );
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return [
            'userId' => (string)$this->userId,
            'iban' => (string)$this->iban,
            'date' => $this->date->format('Y-m-d\TH:i:s.uP'),
        ];
    }
}
