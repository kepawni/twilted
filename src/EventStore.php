<?php declare(strict_types=1);
namespace Kepawni\Twilted;

/**
 * Stores events for an entity/aggregate ID in an ordered, append-only fashion and can retrieve all events for an ID.
 */
interface EventStore
{
    public function append(EventStream $events): void;

    public function retrieve(EntityIdentifier $id): EventStream;
}
