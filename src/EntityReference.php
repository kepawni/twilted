<?php declare(strict_types=1);
namespace Kepawni\Twilted;

/**
 * Something that references an entity (or an aggregate) by its ID.
 */
interface EntityReference
{
    public function getId(): EntityIdentifier;
}
