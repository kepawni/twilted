<?php declare(strict_types=1);
namespace Kepawni\Twilted\Basic\TestSample\Event;

use Kepawni\Twilted\Basic\EqualsUsesWindUp;
use Kepawni\Twilted\EventPayload;
use Kepawni\Twilted\Windable;

class ItemWasAddedToShoppingBasket implements EventPayload
{
    use EqualsUsesWindUp;
    private $itemCode;
    private $quantity;

    public function __construct(string $itemCode, int $quantity)
    {
        $this->itemCode = $itemCode;
        $this->quantity = $quantity;
    }

    public static function unwind(array $spool): Windable
    {
        return new static($spool[0], $spool[1]);
    }

    public function getItemCode(): string
    {
        return $this->itemCode;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function windUp(): array
    {
        return [$this->itemCode, $this->quantity];
    }
}
