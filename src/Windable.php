<?php declare(strict_types=1);
namespace Kepawni\Twilted;

/**
 * Instances can be wound up into an indexed array and can be restored by unwinding such an array. The array may
 * contain other arrays but no instances of any class and no resources.
 */
interface Windable
{
    /**
     * @param array $spool The compact representation of this instance.
     *
     * @return static The instance reconstituted from unwinding the spool.
     */
    static function unwind(array $spool): self;

    /**
     * @return array A compact representation (like a spool) of this instance which must not contain any unwound object
     *     instances or resource handles.
     */
    function windUp(): array;
}
