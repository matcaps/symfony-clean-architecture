<?php

namespace MatCaps\Beta\Domain\Tests\TextBook\Repository;

use LogicException;
use MatCaps\Beta\Domain\Command\TextBook\TextBookNoteCommandInterface;
use MatCaps\Beta\Domain\Entity\TextBook\TextBookNote;
use MatCaps\Beta\Domain\Gateway\TextBook\TextBookNoteGateway;

class TextBookNoteRepository implements TextBookNoteGateway
{
    /** @var array<TextBookNote> */
    private array $items = [];

    public function findById(string $id): ?TextBookNote
    {
        return $this->items[$id] ?? null;
    }

    public function findAll(): array
    {
        return $this->items;
    }

    public function update(TextBookNote $note): bool
    {
        if (empty($this->items[$note->getId()])) {
            throw new LogicException("Cannot update a TextBookNote which is not set in Repository");
        }

        $this->items[$note->getId()] = $note;
        return true;
    }

    public function save(TextBookNote $note): bool
    {
        $this->items[$note->getId()] = $note;
        return true;
    }

    public function remove(TextBookNote $note): bool
    {
        unset($this->items[$note->getId()]);
        return true;
    }
}
