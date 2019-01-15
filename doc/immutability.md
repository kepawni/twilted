[home](../README.md)

# Immutability

It is important to eliminate side effects, which also means waving good-bye to setters. For configuring complex instances we use with…($value) methods that can be chained and always return a new instance.

When writing them by hand it becomes painful after five or six such classes. That's why we cut the boilerplate code and added a base class with just the right amount of magic so you can get to the point as swiftly as possible. (If that still isn't enough for you have a look at *kepawni/serge* where we're working on a code generator to make it even easier.)

Example how to define a simple value object for an RGB color.

```php
/**
 * @property-read int $red
 * @property-read int $green
 * @property-read int $blue
 * @method self withRed(int $v)
 * @method self withGreen(int $v)
 * @method self withBlue(int $v)
 */
final class Color extends ImmutableValue
{
    public function __construct(int $red, int $green, int $blue)
    {
        $this->init('red', $red);
        $this->init('green', $green);
        $this->init('blue', $blue);
    }
}
```

ImmutableValue takes care of providing those magic getters and methods, however it is highly recommended to declare them using `@property-read` and `@method` so your IDE can help you intellisensing your way through these value objects.
