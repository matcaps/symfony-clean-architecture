<?php

namespace MatCaps\Beta\Domain\Response\TextBook;

use MatCaps\Beta\Domain\Entity\TextBook\Textbook;

class ShareTextBookResponse
{
    /** @var array<TextBook> */
    private array $sharedTextBookEntries;


    /**
     * ShareTextBookResponse constructor.
     * @param array<TextBook> $sharedTextBookEntries
     */
    public function __construct(array $sharedTextBookEntries)
    {
        $this->sharedTextBookEntries = $sharedTextBookEntries;
    }

    /**
     * @return array<TextBook>
     */
    public function getEntries(): array
    {
        return $this->sharedTextBookEntries;
    }
}
