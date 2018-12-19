<?php declare(strict_types=1);
namespace Kepawni\Twilted\Basic;

use DateTimeInterface;
use Kepawni\Twilted\DomainEvent;
use Kepawni\Twilted\EntityIdentifier;
use Kepawni\Twilted\EventPayload;

/**
 * An event that occurred on an aggregate at a time in the past loaded with an EventPayload carrying the details.
 */
class SimpleDomainEvent implements DomainEvent
{
    private $entityId;
    private $payload;
    private $recordedOn;

    public function __construct(EventPayload $payload, EntityIdentifier $entityId, DateTimeInterface $recordedOn)
    {
        $this->payload = $payload;
        $this->entityId = $entityId;
        $this->recordedOn = $recordedOn;
    }

    public function getId(): EntityIdentifier
    {
        return $this->entityId;
    }

    public function getPayload(): EventPayload
    {
        return $this->payload;
    }

    public function getRecordedOn(): DateTimeInterface
    {
        return $this->recordedOn;
    }
}
