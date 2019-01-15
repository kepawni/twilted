# twilted
CQRS and Event Sourcing—The Way I Like To Engineer Domains

## Status

[![Build Status](https://travis-ci.org/kepawni/twilted.svg)](https://travis-ci.org/kepawni/twilted)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kepawni/twilted/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kepawni/twilted/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/kepawni/twilted/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

[read more...](doc/status.md)

## Concepts

### Serializing instances

Instead of relying on PHP's built-in serialization format on the one hand or enforcing the use of a certain format like JSON (even if it is a wise option) on the other hand, we decided to use an own way of simplifying instances for storing them that doesn't get in your way too much but won't cause a lot of extra work either.

[read more...](doc/serializing-instances.md)

### Immutability

It is important to eliminate side effects, which also means waving good-bye to setters. For configuring complex instances we use with…($value) methods that can be chained and always return a new instance.

[read more...](doc/immutability.md)

### Project structure

The core namespace \Kepawni\Twilted contains nothing but essential interfaces and an abstract class.

However, some basic convenience classes that can be used as an out-of-the-box solution can be found in \Kepawni\Twilted\Basic. These rely heavily on traits to cater for easy reuse while causing minimal coding.


[read more...](doc/structure.md)
