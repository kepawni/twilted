<?php declare(strict_types=1);
namespace Kepawni\Twilted\Basic\TestSample\Event;

use Kepawni\Twilted\Basic\EqualsUsesWindUp;
use Kepawni\Twilted\EventPayload;
use Kepawni\Twilted\Windable;

class ShoppingBasketWasCheckedOut implements EventPayload
{
    use EqualsUsesWindUp;
    private $returningCustomerId;

    public function __construct(string $returningCustomerId)
    {
        $this->returningCustomerId = $returningCustomerId;
    }

    public static function unwind(array $spool): Windable
    {
        return new static($spool[0]);
    }

    public function getReturningCustomerId(): string
    {
        return $this->returningCustomerId;
    }

    public function windUp(): array
    {
        return [$this->returningCustomerId];
    }
}
