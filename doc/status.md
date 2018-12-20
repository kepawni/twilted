[home](../README.md)

# Status

Branch | Travis CI status
-----: | :---
master | [![Build Status](https://travis-ci.org/kepawni/twilted.svg?branch=master)](https://travis-ci.org/kepawni/twilted)
v1.0.1 | [![Build Status](https://travis-ci.org/kepawni/twilted.svg?branch=v1.0.1)](https://travis-ci.org/kepawni/twilted)
v1.0.2 | [![Build Status](https://travis-ci.org/kepawni/twilted.svg?branch=v1.0.2)](https://travis-ci.org/kepawni/twilted)

## PhpSpec results

```
      Kepawni\Twilted\Basic\AggregateUuid

  12  ✔ can be created from a UUID string
  19  ✔ can be created from randomness
  26  ✔ can be folded to a string
  32  ✔ doesnt equal an instance with another UUID
  38  ✔ equals another instance based on the same UUID

      Kepawni\Twilted\Basic\SimpleDomainEvent

  12  ✔ is initializable
  17  ✔ provides the entity ID
  22  ✔ provides the event data
  27  ✔ provides the recorded time

      Kepawni\Twilted\Basic\SimpleEventStream

  12  ✔ is initializable
  18  ✔ provides an iterator

      Kepawni\Twilted\Basic\TestSample\ImmutableValueImpl

  12  ✔ breaks object references
  34  ✔ configures a new instance
  41  ✔ equals an instance with equal data
  47  ✔ is initializable

      Kepawni\Twilted\Basic\TestSample\ShoppingBasket

  80  ✔ allows checkout with at least one item
  91  ✔ allows quick checkout for returning customers
 103  ✔ can be instantiated when picked up by a new customer
 111  ✔ can be instantiated when picked up by a returning customer
 120  ✔ prevents adding items after checkout
 132  ✔ prevents checkout without items
 140  ✔ prevents quick checkout for new customers
 150  ✔ provides the entity ID
 155  ✔ starts off with one recorded event


5 specs
24 examples (24 passed)
194ms
```
