<?php declare(strict_types=1);
namespace spec\Kepawni\Twilted;

use Kepawni\Twilted\AggregateIdentifier;
use Kepawni\Twilted\Equatable;
use Kepawni\Twilted\Foldable;
use PhpSpec\ObjectBehavior;

class AggregateIdentifierSpec extends ObjectBehavior
{
    private $uuid = 'ec35b286-b1c5-43bb-b1db-3b9560047ff1';

    function it_can_be_created_randomly()
    {
        $this->beConstructedThroughCreateRandom($this->uuid);
        $this->shouldImplement(Equatable::class);
        $this->shouldImplement(Foldable::class);
        $this->shouldBeAnInstanceOf(AggregateIdentifier::class);
    }

    function it_equals_a_similar_instance()
    {
        $other = AggregateIdentifier::unfold($this->uuid);
        $this->equals($other)->shouldBe(true);
    }

    function it_folds_to_a_UUID_string()
    {
        $this->fold()->shouldMatch('/^[\\da-f]{8}(-[\\da-f]{4}){4}[\\da-f]{8}$/');
    }

    function it_unfolds_from_a_UUID_string()
    {
        $this->shouldImplement(Equatable::class);
        $this->shouldImplement(Foldable::class);
        $this->shouldBeAnInstanceOf(AggregateIdentifier::class);
    }

    function let()
    {
        $this->beConstructedThroughUnfold($this->uuid);
    }
}
