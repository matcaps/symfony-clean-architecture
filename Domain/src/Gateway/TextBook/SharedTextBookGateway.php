<?php

namespace MatCaps\Beta\Domain\Gateway\TextBook;

use MatCaps\Beta\Domain\Entity\Generics\SchoolClass;
use MatCaps\Beta\Domain\Entity\TextBook\Textbook;

interface SharedTextBookGateway
{
    public function share(Textbook $textBook, SchoolClass $schoolClass): void;

    /**
     * @param SchoolClass $schoolClass
     * @return array<Textbook>
     */
    public function findAllSharedWith(SchoolClass $schoolClass): array;
}
