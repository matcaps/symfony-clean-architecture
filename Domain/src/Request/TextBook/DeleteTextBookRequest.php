<?php

namespace MatCaps\Beta\Domain\Request\TextBook;

use MatCaps\Beta\Domain\Entity\TextBook\Textbook;

class DeleteTextBookRequest
{
    private Textbook $textbook;

    public function __construct(Textbook $textbook)
    {
        $this->textbook = $textbook;
    }

    public function getTextbook(): Textbook
    {
        return $this->textbook;
    }
}
