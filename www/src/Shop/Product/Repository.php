<?php

namespace Shop\Product;

use Broadway\EventHandling\EventBusInterface;
use Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory;
use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventStore\EventStoreInterface;

class Repository extends EventSourcingRepository
{
    public function __construct(
        EventStoreInterface $eventStore,
        EventBusInterface $eventBus
    ) {
        parent::__construct(
            $eventStore,
            $eventBus,
            '\Shop\Product\Aggregate\Product',
            new PublicConstructorAggregateFactory());
    }
}