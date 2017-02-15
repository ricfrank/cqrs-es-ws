<?php

namespace Shop\Common\Process;

use Broadway\Processor\Processor;
use Shop\Product\Event\ProductCreated;


/**
 * Class Mailer
 *
 * @package Soisy\Domain\Common\Service
 */
class Mailer extends Processor
{
    /**
     * @var \Shop\Common\Service\Mailer
     */
    private $mailer;

    public function __construct(\Shop\Common\Service\Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param ProductCreated $event
     */
    public function handleProductCreated(ProductCreated $event)
    {
        $body = 'Il prodotto ' . $event->getBarcode() . ' è stato aggiunto';

        $this->mailer->send('admin@cqrs-es-ws.dev', 'rf@ideato.it', $body);
    }
}
