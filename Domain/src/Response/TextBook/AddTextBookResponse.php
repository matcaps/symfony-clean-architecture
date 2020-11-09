<?php

namespace MatCaps\Beta\Domain\Response\TextBook;

use DateTimeInterface;
use MatCaps\Beta\Domain\Entity\TextBook\Textbook;

class AddTextBookResponse
{
    private string $id;
    private string $content;
    private DateTimeInterface $dueAt;
    private bool $isShared;

    /**
     * AddTextBookResponse constructor.
     * @param Textbook $textbook
     */
    public function __construct(Textbook $textbook)
    {
        $this->id = $textbook->getId();
        $this->content = $textbook->getContent();
        $this->dueAt = $textbook->getDueAt();
        $this->isShared = $textbook->isShared();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getDueAt(): DateTimeInterface
    {
        return $this->dueAt;
    }

    public function isShared(): bool
    {
        return $this->isShared;
    }
}
