<?php

namespace MatCaps\Beta\Domain\Entity\TextBook;

use MatCaps\Beta\Domain\Entity\Generics\SchoolClass;

class SharedTextBook
{
    private Textbook $textbook;
    private SchoolClass $schoolClass;

    public function __construct(Textbook $textbook, SchoolClass $schoolClass)
    {
        $this->textbook = $textbook;
        $this->schoolClass = $schoolClass;
    }

    public function getTextbook(): Textbook
    {
        return $this->textbook;
    }

    public function getSchoolClass(): SchoolClass
    {
        return $this->schoolClass;
    }
}
