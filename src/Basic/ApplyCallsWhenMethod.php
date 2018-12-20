<?php declare(strict_types=1);
namespace Kepawni\Twilted\Basic;

use Kepawni\Twilted\DomainEvent;
use Verraes\ClassFunctions\ClassFunctions;

trait ApplyCallsWhenMethod
{
    /**
     * Delegate the application of the event to the appropriate when... method, e. g. a VisitorHasLeft event will be
     * processed by the (private) method whenVisitorHasLeft(VisitorHasLeft $event): void
     *
     * @param DomainEvent $event
     */
    protected function apply(DomainEvent $event): void
    {
        $method = 'when' . ClassFunctions::short($event->getPayload());
        $this->$method($event->getPayload(), $event);
    }
}
