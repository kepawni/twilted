<?php declare(strict_types=1);
namespace Kepawni\Twilted\Basic;

use Assert\Assert;
use Kepawni\Twilted\EntityHistory;
use Kepawni\Twilted\EntityIdentifier;
use Kepawni\Twilted\EventBus;
use Kepawni\Twilted\EventSourcedEntity;
use Kepawni\Twilted\EventStore;
use Kepawni\Twilted\IdentifiableEventSourcedEntity;
use Kepawni\Twilted\Repository;

class SimpleRepository implements Repository
{
    /** @var string|EventSourcedEntity */
    private $entityClass;
    private $eventBus;
    private $eventStore;
    /** @var string|EntityHistory */
    private $historyClass;

    public function __construct(string $entityClass, EventBus $eventBus, EventStore $eventStore, string $historyClass = SimpleAggregateHistory::class)
    {
        Assert::that($entityClass)->implementsInterface(EventSourcedEntity::class);
        $this->entityClass = $entityClass;
        $this->eventBus = $eventBus;
        $this->eventStore = $eventStore;
        $this->historyClass = $historyClass;
    }

    public function load(EntityIdentifier $identifier): EventSourcedEntity
    {
        $eventStream = $this->eventStore->retrieve($identifier);
        $aggregateHistory = new $this->historyClass($identifier, $eventStream);
        return $this->entityClass::reconstituteFrom($aggregateHistory);
    }

    public function save(IdentifiableEventSourcedEntity $entity): void
    {
        $eventStream = $entity->getRecordedEvents();
        $this->eventStore->append($eventStream);
        $this->eventBus->dispatch($eventStream);
    }
}
