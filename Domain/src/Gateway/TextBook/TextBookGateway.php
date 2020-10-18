<?php

namespace MatCaps\Beta\Domain\Gateway\TextBook;

use MatCaps\Beta\Domain\Entity\TextBook\Textbook;

interface TextBookGateway
{

    public function add(TextBook $textBook): void;

    public function findById(string $id): ?Textbook;
}
