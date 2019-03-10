<?php declare(strict_types=1);
namespace Kepawni\Twilted\Basic;

use Kepawni\Twilted\EntityIdentifier;
use Kepawni\Twilted\EventSourcedEntity;
use Kepawni\Twilted\IdentifiableEventSourcedEntity;
use Kepawni\Twilted\Repository;

/**
 * A simple command handler that can load from and save to a repository.
 * Subclasses should provide a method for each command handled.
 */
abstract class SimpleCommandHandler
{
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param EntityIdentifier $aggregateId
     *
     * @return IdentifiableEventSourcedEntity
     */
    protected function loadFromRepository(EntityIdentifier $aggregateId): EventSourcedEntity
    {
        return $this->repository->load($aggregateId);
    }

    protected function saveToRepository(IdentifiableEventSourcedEntity $aggregate): void
    {
        $this->repository->save($aggregate);
    }
}
