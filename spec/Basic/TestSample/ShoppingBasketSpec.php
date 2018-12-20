<?php declare(strict_types=1);
namespace spec\Kepawni\Twilted\Basic\TestSample;

use Kepawni\Twilted\AggregateRoot;
use Kepawni\Twilted\Basic\TestSample\Event\ItemWasAddedToShoppingBasket;
use Kepawni\Twilted\Basic\TestSample\Event\ShoppingBasketWasCheckedOut;
use Kepawni\Twilted\Basic\TestSample\Event\ShoppingBasketWasPickedUpByNewCustomer;
use Kepawni\Twilted\Basic\TestSample\Event\ShoppingBasketWasPickedUpByReturningCustomer;
use Kepawni\Twilted\Basic\TestSample\ShoppingBasket;
use Kepawni\Twilted\DomainEvent;
use Kepawni\Twilted\EntityIdentifier;
use Kepawni\Twilted\EntityReference;
use Kepawni\Twilted\EventPayload;
use Kepawni\Twilted\EventSourcedEntity;
use Kepawni\Twilted\EventStream;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;

class ShoppingBasketSpec extends ObjectBehavior
{
    private $returningCustomerId = 'd643669c-897b-4ceb-91a6-86e9dc3cde80';

    public function getMatchers(): array
    {
        return [
            'iterateWithPayloads' => function ($subject, array $values) {
                if (!is_iterable($subject)) {
                    throw new FailureException('Subject is not iterable.');
                }
                $count = 0;
                foreach ($subject as $index => $item) {
                    $count++;
                    $payloadClass = get_class($item->getPayload());
                    if (!isset($values[$index])) {
                        throw new FailureException(
                            sprintf(
                                'Event at index %d is a %s, but nothing was expected.',
                                $index,
                                $payloadClass
                            )
                        );
                    } elseif (!($values[$index] instanceof EventPayload)) {
                        throw new FailureException(
                            sprintf(
                                'Payload at index %d is a %s, but expected a %s.',
                                $index,
                                get_class($values[$index]),
                                EventPayload::class
                            )
                        );
                    } elseif ($item instanceof DomainEvent) {
                        if ($values[$index] instanceof $payloadClass) {
                            if ($values[$index]->windUp() !== $item->getPayload()->windUp()) {
                                throw new FailureException(
                                    sprintf(
                                        'Event at index %d differs from expected.',
                                        $index
                                    )
                                );
                            }
                        } else {
                            throw new FailureException(
                                sprintf(
                                    'Event at index %d is a %s, but expected a %s.',
                                    $index,
                                    $payloadClass,
                                    get_class($values[$index])
                                )
                            );
                        }
                    } else {
                        throw new FailureException('Subject must contain only DomainEvents.');
                    }
                }
                return $count === count($values);
            },
        ];
    }

    function it_allows_checkout_with_at_least_one_item(ShoppingBasketWasPickedUpByNewCustomer $sbwpubnc, ItemWasAddedToShoppingBasket $iwatsb, ShoppingBasketWasCheckedOut $sbwco)
    {
        $sbwpubnc->windUp()->willReturn([]);
        $this->addItem('code');
        $iwatsb->windUp()->willReturn(['code', 1]);
        $this->checkout('billingData', 'shippingData', 'paymentInformation');
        $sbwco->windUp()->willReturn([ShoppingBasket::FAKE_CUSTOMER_ID]);
        $this->getRecordedEvents()->shouldBeAnInstanceOf(EventStream::class);
        $this->getRecordedEvents()->shouldIterateWithPayloads([$sbwpubnc, $iwatsb, $sbwco]);
    }

    function it_allows_quick_checkout_for_returning_customers(EntityIdentifier $uuid, ShoppingBasketWasPickedUpByReturningCustomer $sbwpubrc, ItemWasAddedToShoppingBasket $iwatsb, ShoppingBasketWasCheckedOut $sbwco)
    {
        $this->beConstructedThroughPickUp($uuid, $this->returningCustomerId);
        $sbwpubrc->windUp()->willReturn([$this->returningCustomerId]);
        $this->addItem('code');
        $iwatsb->windUp()->willReturn(['code', 1]);
        $this->quickCheckout();
        $sbwco->windUp()->willReturn([$this->returningCustomerId]);
        $this->getRecordedEvents()->shouldBeAnInstanceOf(EventStream::class);
        $this->getRecordedEvents()->shouldIterateWithPayloads([$sbwpubrc, $iwatsb, $sbwco]);
    }

    function it_can_be_instantiated_when_picked_up_by_a_new_customer()
    {
        $this->shouldHaveType(ShoppingBasket::class);
        $this->shouldHaveType(AggregateRoot::class);
        $this->shouldHaveType(EntityReference::class);
        $this->shouldHaveType(EventSourcedEntity::class);
    }

    function it_can_be_instantiated_when_picked_up_by_a_returning_customer(EntityIdentifier $uuid)
    {
        $this->beConstructedThroughPickUp($uuid, $this->returningCustomerId);
        $this->shouldHaveType(ShoppingBasket::class);
        $this->shouldHaveType(AggregateRoot::class);
        $this->shouldHaveType(EntityReference::class);
        $this->shouldHaveType(EventSourcedEntity::class);
    }

    function it_prevents_adding_items_after_checkout(ShoppingBasketWasPickedUpByNewCustomer $sbwpubnc, ItemWasAddedToShoppingBasket $iwatsb, ShoppingBasketWasCheckedOut $sbwco)
    {
        $sbwpubnc->windUp()->willReturn([]);
        $this->addItem('code');
        $iwatsb->windUp()->willReturn(['code', 1]);
        $this->checkout('billingData', 'shippingData', 'paymentInformation');
        $sbwco->windUp()->willReturn([ShoppingBasket::FAKE_CUSTOMER_ID]);
        $this->getRecordedEvents()->shouldBeAnInstanceOf(EventStream::class);
        $this->getRecordedEvents()->shouldIterateWithPayloads([$sbwpubnc, $iwatsb, $sbwco]);
        $this->shouldThrow()->duringAddItem('other');
    }

    function it_prevents_checkout_without_items(ShoppingBasketWasPickedUpByNewCustomer $sbwpubnc, ShoppingBasketWasCheckedOut $sbwco)
    {
        $sbwpubnc->windUp()->willReturn([]);
        $this->getRecordedEvents()->shouldBeAnInstanceOf(EventStream::class);
        $this->getRecordedEvents()->shouldIterateWithPayloads([$sbwpubnc]);
        $this->shouldThrow()->duringCheckout('billingData', 'shippingData', 'paymentInformation');
    }

    function it_prevents_quick_checkout_for_new_customers(ShoppingBasketWasPickedUpByNewCustomer $sbwpubnc, ItemWasAddedToShoppingBasket $iwatsb)
    {
        $sbwpubnc->windUp()->willReturn([]);
        $this->addItem('code');
        $iwatsb->windUp()->willReturn(['code', 1]);
        $this->getRecordedEvents()->shouldBeAnInstanceOf(EventStream::class);
        $this->getRecordedEvents()->shouldIterateWithPayloads([$sbwpubnc, $iwatsb]);
        $this->shouldThrow()->duringQuickCheckout();
    }

    function it_provides_the_entity_ID(EntityIdentifier $uuid)
    {
        $this->getId()->shouldBe($uuid);
    }

    function it_starts_off_with_one_recorded_event(EntityIdentifier $uuid, ShoppingBasketWasPickedUpByReturningCustomer $payload)
    {
        $this->beConstructedThroughPickUp($uuid, $this->returningCustomerId);
        $payload->windUp()->willReturn([$this->returningCustomerId]);
        $this->getRecordedEvents()->shouldBeAnInstanceOf(EventStream::class);
        $this->getRecordedEvents()->shouldIterateWithPayloads([$payload]);
    }

    function let(EntityIdentifier $uuid)
    {
        $this->beConstructedThroughPickUp($uuid);
    }
}
