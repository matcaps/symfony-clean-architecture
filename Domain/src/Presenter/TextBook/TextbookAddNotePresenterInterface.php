<?php

namespace MatCaps\Beta\Domain\Presenter\TextBook;

use MatCaps\Beta\Domain\Response\TextBook\AddNoteToTextBookResponse;

interface TextbookAddNotePresenterInterface
{
    public function present(AddNoteToTextBookResponse $response): void;
}
