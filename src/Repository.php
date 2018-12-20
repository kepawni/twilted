<?php declare(strict_types=1);
namespace Kepawni\Twilted;

/**
 * A repository responsible for loading and saving entities (mostly aggregates) sitting between the model and the bare
 * event processing parts.
 */
interface Repository
{
    public function load(EntityIdentifier $identifier): EventSourcedEntity;

    public function save(IdentifiableEventSourceEntity $entity): void;
}
