<?php

namespace MatCaps\Beta\Domain\Entity\TextBook;

use DateTimeImmutable;
use DateTimeInterface;
use MatCaps\Beta\Domain\Request\TextBook\AddNoteToTextBookRequest;
use Ramsey\Uuid\UuidInterface;

class TextBookNote
{
    private DateTimeInterface $createdAt;
    private string $content;
    private UuidInterface $id;

    public function __construct(UuidInterface $id, string $content)
    {
        $this->createdAt = new DateTimeImmutable();
        $this->content = $content;
        $this->id = $id;
    }


    public static function fromAddRequest(AddNoteToTextBookRequest $request): self
    {
        return new self(
            $request->getUuid(),
            $request->getContent()
        );
    }

    /**  */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getId(): string
    {
        return $this->id->toString();
    }
}
