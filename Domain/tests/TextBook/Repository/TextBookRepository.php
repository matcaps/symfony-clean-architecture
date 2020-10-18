<?php

namespace MatCaps\Beta\Domain\Tests\TextBook\Repository;

use MatCaps\Beta\Domain\Entity\TextBook\Textbook;
use MatCaps\Beta\Domain\Gateway\TextBook\TextBookGateway;

class TextBookRepository implements TextBookGateway
{

    /** @var array<TextBook>  */
    private array $items = [];

    /**
     * @param Textbook $textbook
     */
    public function add(Textbook $textbook): void
    {
        $this->items[$textbook->getId()] = $textbook;
    }

    public function findById(string $id): ?Textbook
    {
        return $this->items[$id] ?? null;
    }
}
