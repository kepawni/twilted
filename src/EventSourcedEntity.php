<?php declare(strict_types=1);
namespace Kepawni\Twilted;

/**
 * Implementing classes record events when they change and can be restored from a history of such events.
 */
interface EventSourcedEntity
{
    public static function reconstituteFrom(EntityHistory $history): EventSourcedEntity;

    public function getRecordedEvents(): EventStream;
}
