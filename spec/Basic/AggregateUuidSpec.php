<?php declare(strict_types=1);
namespace spec\Kepawni\Twilted\Basic;

use Kepawni\Twilted\Basic\AggregateUuid;
use Kepawni\Twilted\EntityIdentifier;
use PhpSpec\ObjectBehavior;

class AggregateUuidSpec extends ObjectBehavior
{
    private $uuidString = '71db3e91-ece0-425f-8eb9-77ccfbd53318';

    function it_can_be_created_from_a_UUID_string()
    {
        $this->beConstructedThroughUnfold($this->uuidString);
        $this->shouldHaveType(AggregateUuid::class);
        $this->shouldHaveType(EntityIdentifier::class);
    }

    function it_can_be_created_from_randomness()
    {
        $this->beConstructedThroughCreateRandom();
        $this->shouldHaveType(AggregateUuid::class);
        $this->shouldHaveType(EntityIdentifier::class);
    }

    function it_can_be_folded_to_a_string()
    {
        $this->beConstructedThroughUnfold($this->uuidString);
        $this->fold()->shouldBe($this->uuidString);
    }

    function it_doesnt_equal_an_instance_with_another_UUID()
    {
        $this->beConstructedThroughCreateRandom();
        $this->equals(AggregateUuid::unfold($this->uuidString))->shouldNotBe(true);
    }

    function it_equals_another_instance_based_on_the_same_UUID()
    {
        $this->beConstructedThroughUnfold($this->uuidString);
        $this->equals(AggregateUuid::unfold($this->uuidString))->shouldBe(true);
    }
}
