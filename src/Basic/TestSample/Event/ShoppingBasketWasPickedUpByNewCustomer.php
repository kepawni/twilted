<?php declare(strict_types=1);
namespace Kepawni\Twilted\Basic\TestSample\Event;

use Kepawni\Twilted\Basic\EqualsUsesWindUp;
use Kepawni\Twilted\EventPayload;
use Kepawni\Twilted\Windable;

class ShoppingBasketWasPickedUpByNewCustomer implements EventPayload
{
    use EqualsUsesWindUp;

    public static function unwind(array $spool): Windable
    {
        return new static();
    }

    public function windUp(): array
    {
        return [];
    }
}
