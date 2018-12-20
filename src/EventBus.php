<?php declare(strict_types=1);
namespace Kepawni\Twilted;

/**
 * Receives events (from the repository) and is responsible for passing them on to projectors and services (and maybe
 * to the event store).
 */
interface EventBus
{
    function dispatch(EventStream $events): void;
}
