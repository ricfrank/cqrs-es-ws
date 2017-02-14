<?php

function build(Idephix\Context $context, $runIntegration = 'no')
{
    $context->local("php composer.phar install");
    $context->local("bin/console broadway:event-store:schema:drop");
    $context->local("bin/console broadway:event-store:schema:init");
    $context->local("bin/console cache:clear");

    $context->local("bin/phpunit -c ./ --colors");
}