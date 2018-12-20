<?php declare(strict_types=1);
namespace spec\Kepawni\Twilted\Basic;

use Kepawni\Twilted\Basic\SimpleEventStream;
use Kepawni\Twilted\DomainEvent;
use Kepawni\Twilted\EventStream;
use PhpSpec\ObjectBehavior;
use Traversable;

class SimpleEventStreamSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SimpleEventStream::class);
        $this->shouldHaveType(EventStream::class);
    }

    function it_provides_an_iterator(DomainEvent $domainEvent1, DomainEvent $domainEvent2)
    {
        $this->getIterator()->shouldBeAnInstanceOf(Traversable::class);
        $this->getIterator()->shouldIterateLike([$domainEvent1, $domainEvent2]);
    }

    function let(DomainEvent $domainEvent1, DomainEvent $domainEvent2)
    {
        $this->beConstructedWith([$domainEvent1, $domainEvent2]);
    }
}
