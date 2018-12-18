<?php declare(strict_types=1);
namespace Kepawni\Twilted;

/**
 * Instances can be tested for equality to other values.
 */
interface Equatable
{
    /**
     * @param mixed $other Another value to test.
     *
     * @return bool True when the other value is equal to this instance.
     */
    function equals($other): bool;
}
