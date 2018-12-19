<?php declare(strict_types=1);
namespace Kepawni\Twilted;

/**
 * Implementations carry an {@link EventPayload}.
 */
interface DataCarrier
{
    public function getPayload(): EventPayload;
}
