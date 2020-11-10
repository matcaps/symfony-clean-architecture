<?php

namespace MatCaps\Beta\Domain\Tests\TextBook\Repository;

use LogicException;
use MatCaps\Beta\Domain\Command\TextBook\TextBookCommandInterface;
use MatCaps\Beta\Domain\Entity\Generics\SchoolClass;
use MatCaps\Beta\Domain\Entity\TextBook\Textbook;
use MatCaps\Beta\Domain\Gateway\TextBook\TextBookGateway;

use function array_filter;

class TextBookRepository implements TextBookGateway
{

    /** @var array<TextBook> */
    private array $items = [];

    public function findById(string $id): ?Textbook
    {
        return $this->items[$id] ?? null;
    }

    public function findAll(): array
    {
        return $this->items;
    }

    public function remove(Textbook $textbook): bool
    {
        unset($this->items[$textbook->getId()]);
        return true;
    }

    public function findAllSharedWith(SchoolClass $schoolClass): array
    {
        return array_values(array_filter($this->items, function (Textbook $item) {
            return $item->isShared();
        }));
    }

    public function update(Textbook $textBook): bool
    {
        if (empty($this->items[$textBook->getId()])) {
            throw new LogicException("Cannot update a TextBook which is not set in Repository");
        }

        $this->items[$textBook->getId()] = $textBook;
        return true;
    }

    public function save(Textbook $textBook): bool
    {
        $this->items[$textBook->getId()] = $textBook;
        return true;
    }
}
