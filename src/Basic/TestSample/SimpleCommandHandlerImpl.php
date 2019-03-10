<?php declare(strict_types=1);
namespace Kepawni\Twilted\Basic\TestSample;

use Kepawni\Twilted\Basic\SimpleCommandHandler;
use Kepawni\Twilted\EntityIdentifier;

class SimpleCommandHandlerImpl extends SimpleCommandHandler
{
    public function discontinueProduct(EntityIdentifier $id)
    {
        $product = $this->loadFromRepository($id);
        // $product->discontinue();
        $this->saveToRepository($product);
    }
}
