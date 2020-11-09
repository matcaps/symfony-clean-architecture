<?php

namespace MatCaps\Beta\Domain\Gateway\TextBook;

use MatCaps\Beta\Domain\Entity\TextBook\TextBookNote;

interface TextBookNoteGateway
{
    public function add(TextBookNote $note): void;

    public function findById(string $id): ?TextBookNote;
}
