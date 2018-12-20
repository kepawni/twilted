<?php declare(strict_types=1);
namespace Kepawni\Twilted;

abstract class AggregateRoot implements EntityReference, EventSourcedEntity
{
    /**
     * Applies the event (no matter what, because it has happened already) and update the internal state of this
     * aggregate accordingly.
     *
     * @param DomainEvent $event
     */
    abstract protected function apply(DomainEvent $event): void;

    /**
     * Records a new DomainEvent which has happened just now and which carries the specified payload.
     *
     * @param EventPayload $what
     */
    abstract protected function recordThat(EventPayload $what): void;
}
