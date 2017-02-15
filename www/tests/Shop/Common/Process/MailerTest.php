<?php

namespace Tests\Shop\Common\Process;


use Shop\Common\Service\Mailer;
use Shop\Product\Event\ProductCreated;
use Shop\Product\ValueObject\ProductId;

class MailerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function should_send_email()
    {
        $productCreated = new ProductCreated(
            new ProductId('00000000-0000-0000-0000-000000000321'),
            '5707055029608',
            'Nome prodotto: Scaaarpe',
            'http://static.politifact.com.s3.amazonaws.com/subjects/mugs/fake.png',
            'Brand prodotto: Super Scaaaarpe',
            new \DateTimeImmutable('2017-02-14')
        );

        /** @var Mailer $mailer */
        $mailer = $this->prophesize(Mailer::class);

        $mailer->send(
            'admin@cqrs-es-ws.dev',
            'rf@ideato.it', 'Il prodotto ' . $productCreated->getBarcode() . ' è stato aggiunto'
        )->shouldBeCalled();

        $mailerProcessor = new \Shop\Common\Process\Mailer($mailer->reveal());

        $mailerProcessor->handleProductCreated($productCreated);
    }
}
