<?php

namespace MatCaps\Beta\Domain\Gateway\TextBook;

use MatCaps\Beta\Domain\Entity\TextBook\TextBookNote;

interface TextBookNoteGateway
{
    public function findById(string $id): ?TextBookNote;

    public function save(TextBookNote $textBook): bool;

    public function remove(TextBookNote $textbook): bool;
}
