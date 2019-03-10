<?php declare(strict_types=1);
namespace spec\Kepawni\Twilted\Basic\TestSample;

use Kepawni\Twilted\Basic\SimpleCommandHandler;
use Kepawni\Twilted\EntityIdentifier;
use Kepawni\Twilted\IdentifiableEventSourcedEntity;
use Kepawni\Twilted\Repository;
use PhpSpec\ObjectBehavior;

class SimpleCommandHandlerImplSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SimpleCommandHandler::class);
    }

    function it_uses_the_repository_when_handling_a_command(
        EntityIdentifier $id,
        Repository $repository,
        IdentifiableEventSourcedEntity $entity
    )
    {
        $returnVoid = function (): void {};
        $repository->load($id)->willReturn($entity);
        $repository->save($entity)->will($returnVoid);
        $this->discontinueProduct($id)->shouldBe(null);
    }

    function let(Repository $repository)
    {
        $this->beConstructedWith($repository);
    }
}
