<?php declare(strict_types=1);
namespace Kepawni\Twilted\Basic;

use Kepawni\Twilted\AggregateRoot;

abstract class SimpleAggregateRoot extends AggregateRoot
{
    use ApplyCallsWhenMethod;
    use GetRecordedEventsIsConfigurable;
    use IdentificationIsTrivial;
    use ReconstituteFromIsSimple;
    use RecordThatUsesConfigurableFactories;
}
