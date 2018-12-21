<?php declare(strict_types=1);
namespace spec\Kepawni\Twilted\Basic;

use ArrayIterator;
use Iterator;
use IteratorAggregate;
use Kepawni\Twilted\Basic\SimpleAggregateHistory;
use Kepawni\Twilted\DomainEvent;
use Kepawni\Twilted\EntityIdentifier;
use Kepawni\Twilted\EntityReference;
use Kepawni\Twilted\EventStream;
use PhpSpec\ObjectBehavior;

class SimpleAggregateHistorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SimpleAggregateHistory::class);
        $this->shouldHaveType(EntityReference::class);
        $this->shouldHaveType(EventStream::class);
    }

    function it_iterates_domain_events(EventStream $events, DomainEvent $event1, DomainEvent $event2)
    {
        $events->getIterator()->willReturn(new ArrayIterator([$event1, $event2]));
        $this->shouldBeAnInstanceOf(IteratorAggregate::class);
        $this->getIterator()->shouldBeAnInstanceOf(Iterator::class);
        $this->shouldIterateLike(new ArrayIterator([$event1, $event2]));
    }

    function it_provides_the_ID(EntityIdentifier $id)
    {
        $this->getId()->shouldBe($id);
    }

    function let(EntityIdentifier $id, EventStream $events)
    {
        $this->beConstructedWith($id, $events);
    }
}
