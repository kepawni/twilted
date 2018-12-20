<?php declare(strict_types=1);
namespace spec\Kepawni\Twilted\Basic;

use DateTimeImmutable;
use Kepawni\Twilted\Basic\SimpleDomainEvent;
use Kepawni\Twilted\EntityIdentifier;
use Kepawni\Twilted\EventPayload;
use PhpSpec\ObjectBehavior;

class SimpleDomainEventSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SimpleDomainEvent::class);
    }

    function it_provides_the_entity_ID(EntityIdentifier $entityId)
    {
        $this->getId()->shouldBe($entityId);
    }

    function it_provides_the_event_data(EventPayload $data)
    {
        $this->getPayload()->shouldBe($data);
    }

    function it_provides_the_recorded_time(DateTimeImmutable $recordedOn)
    {
        $this->getRecordedOn()->shouldBe($recordedOn);
    }

    function let(EventPayload $data, EntityIdentifier $entityId, DateTimeImmutable $recordedOn)
    {
        $this->beConstructedWith($data, $entityId, $recordedOn);
    }
}
