<?php declare(strict_types=1);
namespace Kepawni\Twilted\Basic;

use InvalidArgumentException;
use Kepawni\Twilted\EntityIdentifier;
use Kepawni\Twilted\Foldable;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class AggregateUuid implements EntityIdentifier
{
    /** @var UuidInterface */
    private $uuid;

    private function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return static
     * @throws InvalidArgumentException
     * @throws UnsatisfiedDependencyException
     */
    public static function createRandom(): self
    {
        return new static(Uuid::uuid4());
    }

    /**
     * @param string $leaflet The compact representation of this instance.
     *
     * @return static The instance reconstituted from unfolding the leaflet.
     * @throws InvalidUuidStringException When the leaflet is not a valid UUID string.
     */
    public static function unfold(string $leaflet): Foldable
    {
        return new static(Uuid::fromString($leaflet));
    }

    /**
     * @param mixed $other Another value to test.
     *
     * @return bool True when the other value is equal to this instance.
     */
    public function equals($other): bool
    {
        return $other instanceof static && $this->uuid->equals($other->uuid);
    }

    /**
     * @return string A compact representation (like a leaflet) of this instance.
     */
    public function fold(): string
    {
        return $this->uuid->toString();
    }
}
