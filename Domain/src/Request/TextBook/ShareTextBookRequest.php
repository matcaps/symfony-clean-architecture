<?php

namespace MatCaps\Beta\Domain\Request\TextBook;

use MatCaps\Beta\Domain\Entity\Generics\SchoolClass;
use MatCaps\Beta\Domain\Entity\TextBook\Textbook;

/**
 * Class ShareTextBookRequest
 * @package MatCaps\Beta\Domain\Request\TextBook
 */
class ShareTextBookRequest
{

    private SchoolClass $schoolClass;
    private Textbook $textBook;

    /**
     * ShareTextBookRequest constructor.
     * @param Textbook $textBook
     * @param SchoolClass $schoolClass
     */
    public function __construct(TextBook $textBook, SchoolClass $schoolClass)
    {
        $this->textBook = $textBook;
        $this->schoolClass = $schoolClass;
    }

    public function getTextBook(): Textbook
    {
        return $this->textBook;
    }

    public function getSchoolClass(): SchoolClass
    {
        return $this->schoolClass;
    }
}
