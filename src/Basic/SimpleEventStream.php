<?php declare(strict_types=1);
namespace Kepawni\Twilted\Basic;

use ArrayIterator;
use Kepawni\Twilted\DomainEvent;
use Kepawni\Twilted\EventStream;
use Traversable;

class SimpleEventStream implements EventStream
{
    private $events;

    /**
     * SimpleEventStream constructor.
     *
     * @param DomainEvent[] $events
     */
    public function __construct(array $events)
    {
        $this->events = $events;
    }

    /**
     * @return Traversable|DomainEvent[]
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->events);
    }
}
