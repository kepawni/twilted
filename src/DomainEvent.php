<?php declare(strict_types=1);
namespace Kepawni\Twilted;

use DateTimeInterface;
/**
 * An event that occurred on an aggregate at a time in the past loaded with an EventPayload carrying the details.
 */
interface DomainEvent extends DataCarrier
{
    public function getAggregateId(): AggregateIdentifier;

    public function getRecordedOn(): DateTimeInterface;
}
