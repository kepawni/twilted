<?php declare(strict_types=1);
namespace Kepawni\Twilted\Basic;

use Kepawni\Twilted\AggregateRoot;
use Kepawni\Twilted\EntityHistory;
use Kepawni\Twilted\EntityIdentifier;
use Kepawni\Twilted\EventSourcedEntity;

trait ReconstituteFromIsSimple
{
    abstract protected function __construct(EntityIdentifier $id);

    public static function reconstituteFrom(EntityHistory $history): EventSourcedEntity
    {
        /** @var AggregateRoot $aggregate */
        $aggregate = new static($history->getId());
        foreach ($history as $event) {
            $aggregate->apply($event);
        }
        return $aggregate;
    }
}
