<?php declare(strict_types=1);
namespace Kepawni\Twilted;

/**
 * Instances can be folded up into a string and can be restored by unfolding such a string.
 */
interface Foldable
{
    /**
     * @param string $leaflet The compact representation of this instance.
     *
     * @return static The instance reconstituted from unfolding the leaflet.
     */
    static function unfold(string $leaflet): self;

    /**
     * @return string A compact representation (like a leaflet) of this instance.
     */
    function fold(): string;
}
