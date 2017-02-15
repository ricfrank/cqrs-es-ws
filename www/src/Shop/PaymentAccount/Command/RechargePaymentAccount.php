<?php

namespace Shop\PaymentAccount\Command;

use Shop\PaymentAccount\ValueObject\PaymentId;

class RechargePaymentAccount
{
    /**
     * @var PaymentId
     */
    private $paymentId;
    private $total;
    /**
     * @var \DateTimeImmutable
     */
    private $paidAt;

    /**
     * RequestSepaCreditTransfer constructor.
     *
     * @param PaymentId          $paymentId
     * @param                    $total
     * @param \DateTimeImmutable $paidAt
     */
    public function __construct(PaymentId $paymentId, $total, \DateTimeImmutable $paidAt)
    {
        $this->paymentId = $paymentId;
        $this->total = $total;
        $this->paidAt = $paidAt;
    }

    /**
     * @return PaymentId
     */
    public function getPaymentId()
    {
        return $this->paymentId;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getPaidAt()
    {
        return $this->paidAt;
    }
}
