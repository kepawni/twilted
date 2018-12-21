<?php declare(strict_types=1);
namespace Kepawni\Twilted\Basic;

use Kepawni\Twilted\DomainEvent;
use Kepawni\Twilted\EntityHistory;
use Kepawni\Twilted\EntityIdentifier;
use Kepawni\Twilted\EventStream;
use Traversable;

class SimpleAggregateHistory implements EntityHistory
{
    private $events;
    private $id;

    public function __construct(EntityIdentifier $id, EventStream $events)
    {
        $this->id = $id;
        $this->events = $events;
    }

    public function getId(): EntityIdentifier
    {
        return $this->id;
    }

    /**
     * @return Traversable|DomainEvent[]
     */
    public function getIterator(): Traversable
    {
        return $this->events->getIterator();
    }
}
