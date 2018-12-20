<?php declare(strict_types=1);
namespace Kepawni\Twilted;

/**
 * Implementing classes represent details of the changes that happened to an aggregate when a Domain event occurred.
 */
interface EventPayload extends Equatable, Windable
{
}
