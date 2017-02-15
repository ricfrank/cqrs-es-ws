<?php

namespace Shop\User\Event;


use Broadway\Serializer\SerializableInterface;
use Shop\PaymentAccount\ValueObject\Iban;
use Shop\User\ValueObject\UserId;

class IbanVerificationRequested implements SerializableInterface
{
    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var \DateTime
     */
    private $date;
    /**
     * @var Iban
     */
    private $iban;

    /**
     * IbanVerificationRequested constructor.
     *
     * @param UserId    $userId
     * @param Iban      $iban
     * @param \DateTimeImmutable $date
     */
    public function __construct(UserId $userId, Iban $iban, \DateTimeImmutable $date)
    {
        $this->userId = $userId;
        $this->date = $date;
        $this->iban = $iban;
    }

    /**
     * @return UserId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return Iban
     */
    public function getIban()
    {
        return $this->iban;
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
            'date' => $this->date->format('Y-m-d\TH:i:s.uP')
        ];
    }
}
