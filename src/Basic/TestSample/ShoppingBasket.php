<?php declare(strict_types=1);
namespace Kepawni\Twilted\Basic\TestSample;

use Assert\Assert;
use Kepawni\Twilted\Basic\SimpleAggregateRoot;
use Kepawni\Twilted\Basic\TestSample\Event\ItemWasAddedToShoppingBasket;
use Kepawni\Twilted\Basic\TestSample\Event\ShoppingBasketWasCheckedOut;
use Kepawni\Twilted\Basic\TestSample\Event\ShoppingBasketWasPickedUpByNewCustomer;
use Kepawni\Twilted\Basic\TestSample\Event\ShoppingBasketWasPickedUpByReturningCustomer;
use Kepawni\Twilted\EntityIdentifier;

class ShoppingBasket extends SimpleAggregateRoot
{
    const FAKE_CUSTOMER_ID = '8ccbb53b-6f23-43b8-be73-00efdfb90996';
    private $isClosed = false;
    private $items = [];
    /** @var string|null */
    private $returningCustomerId = null;

    public static function pickUp(EntityIdentifier $uuid, string $returningCustomerId = null)
    {
        $basket = new static($uuid);
        if ($returningCustomerId) {
            Assert::that($returningCustomerId)->uuid();
            $basket->recordThat(new ShoppingBasketWasPickedUpByReturningCustomer($returningCustomerId));
        } else {
            $basket->recordThat(new ShoppingBasketWasPickedUpByNewCustomer());
        }
        return $basket;
    }

    public function addItem(string $itemCode, int $quantity = 1)
    {
        Assert::that($this->isClosed)->false('Basket has been closed during checkout');
        $this->recordThat(new ItemWasAddedToShoppingBasket($itemCode, $quantity));
    }

    public function checkout($billingData, $shippingData, $paymentInformation)
    {
        Assert::that(array_sum($this->items))->greaterThan(0, 'Empty baskets cannot be processed');
        $newCustomerId = $this->magicallyCreateCustomerId($billingData, $shippingData, $paymentInformation);
        $this->recordThat(new ShoppingBasketWasCheckedOut($newCustomerId));
    }

    public function quickCheckout()
    {
        Assert::that(array_sum($this->items))->greaterThan(0, 'Empty baskets cannot be processed');
        Assert::that($this->returningCustomerId)->notNull('Quick checkout is possible only for returning customers');
        $this->recordThat(new ShoppingBasketWasCheckedOut($this->returningCustomerId ?: ''));
    }

    protected function whenItemWasAddedToShoppingBasket(ItemWasAddedToShoppingBasket $event)
    {
        $this->items[$event->getItemCode()] = $this->items[$event->getItemCode()] ?? 0;
        $this->items[$event->getItemCode()] += $event->getQuantity();
    }

    protected function whenShoppingBasketWasCheckedOut(ShoppingBasketWasCheckedOut $event)
    {
        $this->isClosed = true;
        $this->items = [];
    }

    protected function whenShoppingBasketWasPickedUpByNewCustomer(ShoppingBasketWasPickedUpByNewCustomer $event)
    {
    }

    protected function whenShoppingBasketWasPickedUpByReturningCustomer(ShoppingBasketWasPickedUpByReturningCustomer $event)
    {
        $this->returningCustomerId = $event->getReturningCustomerId();
    }

    private function magicallyCreateCustomerId($billingData, $shippingData, $paymentInformation): string
    {
        return self::FAKE_CUSTOMER_ID;
    }
}
