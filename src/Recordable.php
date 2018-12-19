<?php declare(strict_types=1);
namespace Kepawni\Twilted;

use DateTimeInterface;

/**
 * Something that can be recorded on a certain point in time.
 */
interface Recordable
{
    public function getRecordedOn(): DateTimeInterface;
}
