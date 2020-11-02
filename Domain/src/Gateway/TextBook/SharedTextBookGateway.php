<?php

namespace MatCaps\Beta\Domain\Gateway\TextBook;

use MatCaps\Beta\Domain\Entity\Generics\SchoolClass;
use MatCaps\Beta\Domain\Entity\TextBook\SharedTextBook;
use MatCaps\Beta\Domain\Entity\TextBook\Textbook;

interface SharedTextBookGateway
{
    public function share(SharedTextBook $textBook): bool;

    /**
     * @param SchoolClass $schoolClass
     * @return array<Textbook>
     */
    public function findAllSharedWith(SchoolClass $schoolClass): array;
}
