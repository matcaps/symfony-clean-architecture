<?php

namespace App\Infrastructure\Ports\Secondary\TextBook;

use MatCaps\Beta\Domain\Entity\Generics\SchoolClass;
use MatCaps\Beta\Domain\Entity\TextBook\Textbook;
use MatCaps\Beta\Domain\Gateway\TextBook\SharedTextBookGateway;

use function array_fill;
use function array_filter;
use function array_push;

class SharedTextBookRepository implements SharedTextBookGateway
{
    /** @var array  */
    private array $items = [];

    public function share(Textbook $textbook, SchoolClass $schoolClass): void
    {
        $this->items[$schoolClass->getId()][] = $textbook;
    }

    /**
     * @param SchoolClass $schoolClass
     * @return array<Textbook>
     */
    public function findAllSharedWith(SchoolClass $schoolClass): array
    {
        return $this->items[$schoolClass->getId()] ?? [];
    }
}
