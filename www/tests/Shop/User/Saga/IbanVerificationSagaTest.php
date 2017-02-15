<?php

namespace Tests\Shop\User\Saga;

use Broadway\CommandHandling\CommandBusInterface;
use Broadway\Saga\SagaInterface;
use Broadway\Saga\Testing\SagaScenarioTestCase;
use Shop\Common\Service\UuidGenerator;
use Shop\PaymentAccount\Command\RechargePaymentAccount;
use Shop\PaymentAccount\ValueObject\Iban;
use Shop\PaymentAccount\ValueObject\PaymentId;
use Shop\User\Command\NotifyUser;
use Shop\User\Command\StartIbanVerification;
use Shop\User\Event\IbanNotVerified;
use Shop\User\Event\IbanVerificationRequested;
use Shop\User\Event\IbanVerified;
use Shop\User\Saga\IbanVerificationSaga;
use Shop\User\ValueObject\UserId;

class IbanVerificationSagaTest extends SagaScenarioTestCase
{
    /**
     * @var \Shop\Common\Service\UuidGenerator
     */
    private $uuidGenerator;

    /**
     * @test
     */
    public function iban_should_be_verified()
    {
        $userId = new UserId('00000000-0000-0000-0000-000000000560');
        $date = new \DateTimeImmutable('2017-02-15');
        $iban = new Iban('IT40S05428111010000AA123456');
        $paymentId = '00000000-0000-0000-0000-000000000561';

        $this->uuidGenerator->generate()->willReturn($paymentId);

        $this->scenario
            ->given([])
            ->when(new IbanVerificationRequested($userId, $iban, $date))
            ->then([
                new StartIbanVerification($userId, $iban, $date),
            ])
            ->when(new IbanVerified($userId, $iban, $date))
            ->then([
                new StartIbanVerification($userId, $iban, $date),
                new RechargePaymentAccount(new PaymentId($paymentId), 1, $date)
//                new NotifyUser($userId, $date)
            ])
        ;
    }

    /**
     * @test
     */
    public function iban_should_be_not_verified()
    {
        $userId = new UserId('00000000-0000-0000-0000-000000000560');
        $date = new \DateTimeImmutable('2017-02-15');
        $iban = new Iban('IT40S05428111010000AA123456');

        $this->scenario
            ->given([])
            ->when(new IbanVerificationRequested($userId, $iban, $date))
            ->then([
                new StartIbanVerification($userId, $iban, $date),
            ])
            ->when(new IbanNotVerified(new UserId('00000000-0000-0000-0000-000000000560'), $iban, $date))
            // per vedere che la saga non viene riattivata dato che non trova lo userId
//            ->when(new IbanNotVerified(new UserId('00000000-0000-0000-0000-000000000569'), $iban, $date))
            ->then([
                new StartIbanVerification($userId, $iban, $date),
                new NotifyUser($userId, $date)
            ])
        ;
    }

    /**
     * Create the saga you want to test in this test case.
     *
     * @param CommandBusInterface $commandBus
     *
     * @return SagaInterface
     */
    protected function createSaga(CommandBusInterface $commandBus)
    {
        $this->uuidGenerator = $this->prophesize(UuidGenerator::class);

        return new IbanVerificationSaga($commandBus, $this->uuidGenerator->reveal());
    }
}
