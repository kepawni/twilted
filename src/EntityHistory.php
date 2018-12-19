<?php declare(strict_types=1);
namespace Kepawni\Twilted;

/**
 * Represents the history of an aggregate by tying an event stream to an aggregate.
 */
interface EntityHistory extends EntityReference, EventStream
{
}
