<?php

namespace MatCaps\Beta\Domain\Response\TextBook;

use DateTimeInterface;
use MatCaps\Beta\Domain\Entity\TextBook\Textbook;

class AddTextBookResponse
{
    /**
     *
     */
    private Textbook $textbook;
    private string $id;
    private string $content;
    private DateTimeInterface $dueAt;

    /**
     * AddTextBookResponse constructor.
     * @param Textbook $textbook
     */
    public function __construct(Textbook $textbook)
    {
        $this->textbook = $textbook;
        $this->id = $textbook->getId();
        $this->content = $textbook->getContent();
        $this->dueAt = $textbook->getDueAt();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return DateTimeInterface
     */
    public function getDueAt(): DateTimeInterface
    {
        return $this->dueAt;
    }
}
