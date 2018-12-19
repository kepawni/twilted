<?php declare(strict_types=1);
namespace Kepawni\Twilted\Basic;

use Kepawni\Twilted\EntityIdentifier;

trait IdentificationIsTrivial
{
    private $id;

    protected function __construct(EntityIdentifier $id)
    {
        $this->id = $id;
    }

    public function getId(): EntityIdentifier
    {
        return $this->id;
    }
}
