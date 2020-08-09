[home](../README.md)

# Status

## Scrutinizer CI
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kepawni/twilted/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kepawni/twilted/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/kepawni/twilted/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

## Travis CI
Branch | Travis CI status
-----: | :---
dev | [![Build Status](https://travis-ci.org/kepawni/twilted.svg?branch=dev)](https://travis-ci.org/kepawni/twilted)
v1.2.1 | [![Build Status](https://travis-ci.org/kepawni/twilted.svg?branch=v1.2.1)](https://travis-ci.org/kepawni/twilted)
v1.2.0 | [![Build Status](https://travis-ci.org/kepawni/twilted.svg?branch=v1.2.0)](https://travis-ci.org/kepawni/twilted)
v1.1.5 | [![Build Status](https://travis-ci.org/kepawni/twilted.svg?branch=v1.1.5)](https://travis-ci.org/kepawni/twilted)
v1.1.4 | [![Build Status](https://travis-ci.org/kepawni/twilted.svg?branch=v1.1.4)](https://travis-ci.org/kepawni/twilted)
v1.1.3 | [![Build Status](https://travis-ci.org/kepawni/twilted.svg?branch=v1.1.3)](https://travis-ci.org/kepawni/twilted)
v1.1.2 | [![Build Status](https://travis-ci.org/kepawni/twilted.svg?branch=v1.1.2)](https://travis-ci.org/kepawni/twilted)
v1.1.1 | [![Build Status](https://travis-ci.org/kepawni/twilted.svg?branch=v1.1.1)](https://travis-ci.org/kepawni/twilted)
v1.1.0 | [![Build Status](https://travis-ci.org/kepawni/twilted.svg?branch=v1.1.0)](https://travis-ci.org/kepawni/twilted)
v1.0.2 | [![Build Status](https://travis-ci.org/kepawni/twilted.svg?branch=v1.0.2)](https://travis-ci.org/kepawni/twilted)
v1.0.1 | [![Build Status](https://travis-ci.org/kepawni/twilted.svg?branch=v1.0.1)](https://travis-ci.org/kepawni/twilted)

## PhpSpec results

```

      Kepawni\Twilted\Basic\AggregateUuid

  12  ✔ can be created from a UUID string
  19  ✔ can be created from randomness
  26  ✔ can be folded to a string
  32  ✔ doesnt equal an instance with another UUID
  38  ✔ equals another instance based on the same UUID

      Kepawni\Twilted\Basic\SimpleAggregateHistory

  16  ✔ is initializable
  23  ✔ iterates domain events
  31  ✔ provides the ID

      Kepawni\Twilted\Basic\SimpleDomainEvent

  12  ✔ is initializable
  17  ✔ provides the entity ID
  22  ✔ provides the event data
  27  ✔ provides the recorded time

      Kepawni\Twilted\Basic\SimpleEventStream

  12  ✔ is initializable
  18  ✔ provides an iterator

      Kepawni\Twilted\Basic\SimpleRepository

  24  ✔ can load an entity
  44  ✔ can save an entity
  52  ✔ is initializable

      Kepawni\Twilted\Basic\TestSample\ImmutableValueImpl

  14  ✔ breaks object references
  36  ✔ exposes the properties
  43  ✔ prevents mutation of the properties
  49  ✔ throws exceptions when calling unregistered methods
  55  ✔ configures a new instance
  62  ✔ equals an instance with equal data
  68  ✔ is initializable

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

      Kepawni\Twilted\Basic\TestSample\SimpleCommandHandlerImpl

  12  ✔ is initializable
  17  ✔ uses the repository when handling a command


8 specs
35 examples (35 passed)
249ms
```
