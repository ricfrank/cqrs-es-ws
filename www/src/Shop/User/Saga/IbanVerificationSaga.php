<?php

namespace Shop\User\Saga;

use Broadway\CommandHandling\CommandBusInterface;
use Broadway\Saga\Metadata\StaticallyConfiguredSagaInterface;
use Broadway\Saga\Saga;
use Broadway\Saga\State;
use Shop\Common\Service\UuidGenerator;
use Shop\PaymentAccount\Command\RechargePaymentAccount;
use Shop\PaymentAccount\ValueObject\PaymentId;
use Shop\User\Command\NotifyUser;
use Shop\User\Command\StartIbanVerification;
use Shop\User\Event\IbanNotVerified;
use Shop\User\Event\IbanVerificationRequested;
use Shop\User\Event\IbanVerified;


/**
 * Class IbanVerificationSaga.
 */
class IbanVerificationSaga extends Saga implements StaticallyConfiguredSagaInterface
{
    /**
     * @var CommandBusInterface
     */
    private $commandBus;
    /**
     * @var UuidGenerator
     */
    private $uuidGenerator;

    /**
     * @param CommandBusInterface           $commandBus
     */
    public function __construct(CommandBusInterface $commandBus, UuidGenerator $uuidGenerator)
    {
        $this->commandBus = $commandBus;
        $this->uuidGenerator = $uuidGenerator;
    }

    /**
     * @return array
     */
    public static function configuration()
    {
        return [
            'IbanVerificationRequested' => function (IbanVerificationRequested $event) {
                return null;
            },
            'IbanVerified'   => function (IbanVerified $event) {
                return new State\Criteria([
                    'userId' => (string)$event->getUserId(),
                ]);
            },
            'IbanNotVerified'   => function (IbanNotVerified $event) {
                return new State\Criteria([
                    'userId' => (string)$event->getUserId(),
                ]);
            }
        ];
    }

    /**
     * @param IbanVerificationRequested $event
     * @param State                     $state
     *
     * @return State
     */
    public function handleIbanVerificationRequested(IbanVerificationRequested $event, State $state)
    {
        $state->set('userId', (string)$event->getUserId());

        $this->commandBus->dispatch(new StartIbanVerification(
            $event->getUserId(),
            $event->getIban(),
            $event->getDate()
        ));

        return $state;
    }

    /**
     * @param IbanVerified $event
     * @param State        $state
     *
     * @return State
     */
    public function handleIbanVerified(IbanVerified $event, State $state)
    {
        $this->commandBus->dispatch(new RechargePaymentAccount(
            new PaymentId($this->uuidGenerator->generate()),
            1,
            $event->getDate()
        ));

        $state->setDone();

        return $state;
    }

    /**
     * @param IbanNotVerified $event
     * @param State           $state
     *
     * @return State
     */
    public function handleIbanNotVerified(IbanNotVerified $event, State $state)
    {
        $this->commandBus->dispatch(new NotifyUser($event->getUserId(), $event->getDate()));

        $state->setDone();

        return $state;
    }
}
