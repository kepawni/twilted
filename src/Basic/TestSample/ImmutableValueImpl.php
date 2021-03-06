<?php declare(strict_types=1);
namespace Kepawni\Twilted\Basic\TestSample;

use DateTime;
use InvalidArgumentException;
use Kepawni\Twilted\Basic\ImmutableValue;

/**
 * @property-read string $string
 * @property-read array $array
 * @property-read DateTime $dateTime
 * @property-read string $UpperCaseField
 * @method self withString(string $v)
 * @method self withArray(array $v)
 * @method self withDateTime(DateTime $v)
 * @method self withUpperCaseField(string $v)
 */
class ImmutableValueImpl extends ImmutableValue
{
    /**
     * ImmutableValueImpl constructor.
     * @param string $string
     * @param array $array
     * @param DateTime $dateTime
     * @param string $UpperCaseField
     * @throws InvalidArgumentException
     */
    public function __construct(string $string, array $array, DateTime $dateTime, string $UpperCaseField)
    {
        $this->init('string', $string);
        $this->init('array', $array);
        $this->init('dateTime', $dateTime);
        $this->init('UpperCaseField', $UpperCaseField);
    }

    public function revealArray()
    {
        return array_values((array)$this)[0];
    }
}
