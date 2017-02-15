<?php

namespace Shop\User\Command;


use Shop\User\ValueObject\UserId;

class NotifyUser
{
    /**
     * @var UserId
     */
    private $userId;
    /**
     * @var \DateTimeImmutable
     */
    private $notifiedAt;

    /**
     * NotifyUser constructor.
     *
     * @param UserId             $userId
     * @param \DateTimeImmutable $notifiedAt
     */
    public function __construct(UserId $userId, \DateTimeImmutable $notifiedAt)
    {
        $this->userId = $userId;
        $this->notifiedAt = $notifiedAt;
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
    public function getNotifiedAt()
    {
        return $this->notifiedAt;
    }
}