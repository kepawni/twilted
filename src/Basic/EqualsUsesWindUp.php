<?php declare(strict_types=1);
namespace Kepawni\Twilted\Basic;

trait EqualsUsesWindUp
{
    /**
     * @param mixed $other Another value to test.
     *
     * @return bool True when the other value is equal to this instance.
     */
    public function equals($other): bool
    {
        return $other instanceof static && $this->windUp() === $other->windUp();
    }

    abstract public function windUp(): array;
}
