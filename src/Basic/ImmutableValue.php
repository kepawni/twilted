<?php declare(strict_types=1);
namespace Kepawni\Twilted\Basic;

use InvalidArgumentException;
use Kepawni\Twilted\Equatable;
use RuntimeException;

/**
 * Subclasses (which should be final) are immutable and their properties are externally available through magic getters
 * and internally through a protected init method. For each of the properties there is a public method “with...($value)”
 * that returns a deep copy of the instance which differs in that property being set to the new value. It is recommended
 * to use the documentation tags @​property-read and @​method to help IDEs providing intellisense capabilities anyway.
 *
 * CAUTION: The following example contains Zero-Width Space characters before / and after @ to prevent interpretation of
 * doctags and premature comment ending. For a more comfortable copy-and-paste experience this source code can be found
 * at the bottom of the file without those extra ZWS characters.
 *
 * Example:
 *
 *     /**
 *      * @​property-read int $red
 *      * @​property-read int $green
 *      * @​property-read int $blue
 *      * @​method self withRed(int $v)
 *      * @​method self withGreen(int $v)
 *      * @​method self withBlue(int $v)
 *      *​/
 *     final class Color extends ImmutableValue {
 *         public function __construct(int $red, int $green, int $blue) {
 *             $this->init('red', $red);
 *             $this->init('green', $green);
 *             $this->init('blue', $blue);
 *         }
 *     }
 */
abstract class ImmutableValue implements Equatable
{
    private $data = [];

    private static function cloneValue($value)
    {
        return is_array($value)
            ? array_map([self::class, 'cloneValue'], $value)
            : (is_object($value)
                ? clone $value
                : $value
            );
    }

    private static function isEqual($a, $b): bool
    {
        return $a === $b
            || is_array($a) && is_array($b) && count($a) === count($b)
            && count($a) === count(array_filter(array_map([self::class, 'isEqual'], $a, $b)))
            || $a instanceof self && $a->equals($b);
    }

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return ImmutableValue
     * @throws RuntimeException
     */
    public function __call(string $name, array $arguments)
    {
        if (strlen($name) > 4 && substr($name, 0, 4) === 'with' && count($arguments) === 1) {
            $memberName = strtolower($name{4}) . substr($name, 5);
            if (array_key_exists($memberName, $this->data)) {
                $value = self::cloneValue($arguments[0]);
                $result = clone $this;
                $result->data[$memberName] = $value;
                return $result;
            }
        }
        $json = json_encode($arguments);
        throw new RuntimeException(
            'Cannot evaluate (' . get_class($this) . ')->' . $name . '(' . substr($json, 1, -1) . ')'
        );
    }

    public function __clone()
    {
        $this->data = self::cloneValue($this->data);
    }

    /**
     * @param string $name
     *
     * @return mixed
     * @throws RuntimeException
     */
    public function __get(string $name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        throw new RuntimeException('Cannot access (' . get_class($this) . ')->$' . $name);
    }

    /**
     * Checks whether this instance is equal to the given value.
     *
     * @param $other
     *
     * @return bool
     */
    public function equals($other): bool
    {
        return $other instanceof static && self::isEqual(get_object_vars($this), get_object_vars($other));
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @throws InvalidArgumentException
     */
    protected function init(string $name, $value): void
    {
        if (array_key_exists($name, $this->data)) {
            throw new InvalidArgumentException(
                sprintf('Property %s of %s cannot be re-initialized', $name, get_class($this))
            );
        }
        $this->data[$name] = self::cloneValue($value);
    }
}

__halt_compiler();
/**
 * @property-read int $red
 * @property-read int $green
 * @property-read int $blue
 * @method self withRed(int $v)
 * @method self withGreen(int $v)
 * @method self withBlue(int $v)
 */
final class Color extends ImmutableValue {
    public function __construct(int $red, int $green, int $blue) {
        $this->init('red', $red);
        $this->init('green', $green);
        $this->init('blue', $blue);
    }
}
