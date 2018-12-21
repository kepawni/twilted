<?php
namespace spec\Kepawni\Twilted\Basic;

use ArrayIterator;
use DateTimeImmutable;
use Kepawni\Twilted\Basic\AggregateUuid;
use Kepawni\Twilted\Basic\SimpleAggregateHistory;
use Kepawni\Twilted\Basic\SimpleDomainEvent;
use Kepawni\Twilted\Basic\SimpleRepository;
use Kepawni\Twilted\Basic\TestSample\Event\ItemWasAddedToShoppingBasket;
use Kepawni\Twilted\Basic\TestSample\Event\ShoppingBasketWasPickedUpByNewCustomer;
use Kepawni\Twilted\Basic\TestSample\ShoppingBasket;
use Kepawni\Twilted\EntityIdentifier;
use Kepawni\Twilted\EventBus;
use Kepawni\Twilted\EventSourcedEntity;
use Kepawni\Twilted\EventStore;
use Kepawni\Twilted\EventStream;
use Kepawni\Twilted\IdentifiableEventSourcedEntity;
use Kepawni\Twilted\Repository;
use PhpSpec\ObjectBehavior;

class SimpleRepositorySpec extends ObjectBehavior
{
    function it_can_load_an_entity(EventStore $eventStore, EventStream $stream)
    {
        $aggregateUuid = AggregateUuid::createRandom();
        $eventStore->retrieve($aggregateUuid)->willReturn($stream);
        $stream->getIterator()->willReturn(new ArrayIterator([
            new SimpleDomainEvent(
                new ShoppingBasketWasPickedUpByNewCustomer(),
                $aggregateUuid,
                new DateTimeImmutable('1 minute ago')
            ),
            new SimpleDomainEvent(
                new ItemWasAddedToShoppingBasket('itemCode', 2),
                $aggregateUuid,
                new DateTimeImmutable('now')
            ),
        ]));
        $this->load($aggregateUuid)->shouldBeAnInstanceOf(EventSourcedEntity::class);
        $this->load($aggregateUuid)->shouldBeAnInstanceOf(ShoppingBasket::class);
    }

    function it_can_save_an_entity(IdentifiableEventSourcedEntity $aggregate, EntityIdentifier $id, EventStore $eventStore, EventStream $stream)
    {
        $aggregate->getId()->willReturn($id);
        $aggregate->getRecordedEvents()->willReturn($stream);
        $eventStore->append($stream)->shouldBeCalledOnce();
        $this->save($aggregate);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SimpleRepository::class);
        $this->shouldHaveType(Repository::class);
    }

    function let(EventBus $eventBus, EventStore $eventStore)
    {
        $this->beConstructedWith(ShoppingBasket::class, $eventBus, $eventStore);
    }
}
