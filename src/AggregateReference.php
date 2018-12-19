<?php declare(strict_types=1);
namespace Kepawni\Twilted;

/**
 * Something that references an aggregate by its ID.
 */
interface AggregateReference
{
    public function getAggregateId(): AggregateIdentifier;
}
