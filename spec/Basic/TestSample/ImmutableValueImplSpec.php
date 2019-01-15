<?php declare(strict_types=1);
namespace spec\Kepawni\Twilted\Basic\TestSample;

use DateTime;
use DateTimeInterface;
use Kepawni\Twilted\Basic\ImmutableValue;
use Kepawni\Twilted\Basic\TestSample\ImmutableValueImpl;
use Kepawni\Twilted\Equatable;
use PhpSpec\ObjectBehavior;
use RuntimeException;

class ImmutableValueImplSpec extends ObjectBehavior
{
    function it_breaks_object_references()
    {
        $a = 'x';
        $b = &$a;
        $dateTime = new DateTime('2018-10-30T01:51:33Z');
        $array = [&$dateTime, $dateTime, &$b];
        $this->beConstructedWith($b, $array, $dateTime);
        $this->revealArray()->shouldBeLike([
            'array' => [new DateTime('2018-10-30T01:51:33Z'), new DateTime('2018-10-30T01:51:33Z'), 'x'],
            'dateTime' => new DateTime('2018-10-30T01:51:33Z'),
            'string' => 'x'
        ]);
        $b = 'z';
        $array[0]->setTime(2, 3, 4);
        $dateTime->setTime(1, 2, 3);
        $this->revealArray()->shouldBeLike([
            'array' => [new DateTime('2018-10-30T01:51:33Z'), new DateTime('2018-10-30T01:51:33Z'), 'x'],
            'dateTime' => new DateTime('2018-10-30T01:51:33Z'),
            'string' => 'x'
        ]);
    }

    function it_exposes_the_properties()
    {
        $this->array->shouldBe([]);
        $this->string->shouldBe('');
        $this->dateTime->shouldBeAnInstanceOf(DateTimeInterface::class);
    }

    function it_prevents_mutation_of_the_properties()
    {
        $this->shouldThrow()->during__set('string', 'newValue');
        $this->shouldThrow(RuntimeException::class)->duringWithFoo('bar');
    }

    function it_throws_exceptions_when_calling_unregistered_methods()
    {
        $this->shouldThrow(RuntimeException::class)->duringDoStuff();
        $this->shouldThrow(RuntimeException::class)->duringWithFoo('bar');
    }

    function it_configures_a_new_instance()
    {
        $this->withString('x')->shouldBeAnInstanceOf(ImmutableValueImpl::class);
        $this->withString('x')->shouldNotBeLike($this);
        $this->withString('')->shouldBeLike($this);
    }

    function it_equals_an_instance_with_equal_data()
    {
        $this->beConstructedWith('', [], new DateTime('2018-10-30T01:51:33Z'));
        $this->withDateTime(new DateTime('2018-10-30T01:51:33Z'))->equals($this);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ImmutableValueImpl::class);
        $this->shouldHaveType(ImmutableValue::class);
        $this->shouldHaveType(Equatable::class);
    }

    function let()
    {
        $this->beConstructedWith('', [], new DateTime());
    }
}
