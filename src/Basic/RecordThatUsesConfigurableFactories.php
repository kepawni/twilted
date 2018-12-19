<?php declare(strict_types=1);
namespace Kepawni\Twilted\Basic;

use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use Exception;
use Kepawni\Twilted\EntityIdentifier;
use Kepawni\Twilted\DomainEvent;
use Kepawni\Twilted\EventPayload;

trait RecordThatUsesConfigurableFactories
{
    protected static $dateTimeClass = DateTimeImmutable::class;
    protected static $domainEventClass = SimpleDomainEvent::class;
    protected static $timeZoneClass = DateTimeZone::class;
    protected $recordedEvents = [];

    abstract public function getId(): EntityIdentifier;

    abstract protected function apply(DomainEvent $event): void;

    protected function createDateTimeInterfaceForNow(): DateTimeInterface
    {
        $now = null;
        $timeZoneClass = self::$timeZoneClass;
        $dateTimeClass = self::$dateTimeClass;
        try {
            $now = new $dateTimeClass('now', new $timeZoneClass('UTC'));
        } catch (Exception $e) {
            // cannot happen
        }
        return $now;
    }

    protected function createDomainEvent(EventPayload $what, DateTimeInterface $when): SimpleDomainEvent
    {
        $domainEventClass = self::$domainEventClass;
        return new $domainEventClass($what, $this->getId(), $when);
    }

    protected function recordThat(EventPayload $what): void
    {
        $now = $this->createDateTimeInterfaceForNow();
        $recordedEvent = $this->createDomainEvent($what, $now);
        $this->apply($recordedEvent);
        $this->recordedEvents[] = $recordedEvent;
    }
}
