<?php declare(strict_types=1);
namespace Kepawni\Twilted;

use IteratorAggregate;
use Traversable;

interface EventStream extends IteratorAggregate
{
    /**
     * @return Traversable|DomainEvent[]
     */
    public function getIterator(): Traversable;
}
