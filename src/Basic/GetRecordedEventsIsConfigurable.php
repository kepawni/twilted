<?php declare(strict_types=1);
namespace Kepawni\Twilted\Basic;

use Kepawni\Twilted\EventStream;

trait GetRecordedEventsIsConfigurable
{
    protected static $eventStreamClass = SimpleEventStream::class;
    protected $recordedEvents = [];

    public function getRecordedEvents(): EventStream
    {
        $eventStreamClass = self::$eventStreamClass;
        return new $eventStreamClass($this->recordedEvents);
    }
}
