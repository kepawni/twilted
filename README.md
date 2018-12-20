# twilted
CQRS and Event Sourcing—The Way I Like To Engineer Domains

Branch | Travis CI status
-----: | :---
master | [![Build Status](https://travis-ci.org/kepawni/twilted.svg?branch=master)](https://travis-ci.org/kepawni/twilted)
v1.01  | [![Build Status](https://travis-ci.org/kepawni/twilted.svg?branch=v1.0.1)](https://travis-ci.org/kepawni/twilted)

## Concepts

### Serializing instances

Instead of relying on PHP's built-in serialization format on the one hand or enforcing the use of a certain format like JSON (even if it is a wise option) on the other hand, we decided to use an own way of simplifying instances for storing them that doesn't get in your way too much but won't cause a lot of extra work either.

[read more...](doc/serializing-instances.md)
