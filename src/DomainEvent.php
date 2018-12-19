<?php declare(strict_types=1);
namespace Kepawni\Twilted;

/**
 * An event that occurred on an entity at a time in the past loaded with an EventPayload carrying the details.
 */
interface DomainEvent extends DataCarrier, EntityReference, Recordable
{
}
