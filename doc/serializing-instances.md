[home](../README.md)

# Serializing instances

Instead of relying on PHP's built-in serialization format on the one hand or enforcing the use of a certain format like JSON (even if it is a wise option) on the other hand, we decided to use an own way of simplifying instances for storing them that doesn't get in your way too much but won't cause a lot of extra work either.

## Foldable

Simple instances that can be expressed as a string implement Foldable. Using the fold() method such an instance returns its string representation labelled a “leaflet”. A static method unfold(string $leaflet) reconstitutes the instance.

Example for a Fraction class:

```php
public function fold(): string {
    return $this->numerator . '/' . $this->denominator;
}

public static function unfold(string $leaflet): Fraction {
    list($num, $den) = explode('/', $leaflet);
    return new self(intval($num), intval($den));
}
```

## Windable

More complex instances may be harder to convert into a string and would require various escaping strategies to separate their fields. Especially hierarchical object structures would hardly be possible without something like JSON or XML. However PHP arrays still could solve both of these problems and the Windable interface was introduced to wind an instance up into an array representing a “spool” using the windUp() method. The static method unwind(array $spool) is supposed to bring the instance back to life from such a spool.

Example for a Customer class:

```php
public function windUp(): array {
    return [
        $this->firstName,
        $this->lastName,
        $this->billingAddress->fold(),
        $this->shippingAddress->fold(),
        $this->paymentInformation->windUp()
    ];
}

public static function unwind(array $spool): Customer {
    $customer = new self($spool[0], $spool[1]);
    return $customer
        ->withBillingAddress(PostalAddress::unfold($spool[2]))
        ->withShippingAddress(PostalAddress::unfold($spool[3]))
        ->withPaymentInformation(PaymentConfig::unwind($spool[4]));
}
```
