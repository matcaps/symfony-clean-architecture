<?php


namespace MatCaps\Beta\Domain\Request\TextBook;


use Assert\Assert;
use Assert\LazyAssertionException;
use MatCaps\Beta\Domain\Entity\TextBook\Textbook;
use MatCaps\Beta\Domain\Exception\TextBook\InvalidTextBookNoteException;
use Ramsey\Uuid\UuidInterface;


class AddNoteToTextBookRequest
{
    private UuidInterface $uuid;
    private string $content;
    private Textbook $textbook;

    public function __construct(
        UuidInterface $uuid,
        string $content,
        TextBook $textbook
    ) {
        $this->uuid = $uuid;
        $this->content = $content;
        $this->textbook = $textbook;

        $this->validate();
    }

    public static function create(UuidInterface $uuid, string $content, Textbook $textbook): self
    {
        return new self($uuid, $content, $textbook);
    }

    /**
     * @throws InvalidTextBookNoteException
     */
    private function validate() : void
    {
        try {
            Assert::lazy()
                ->that($this->textbook)->isInstanceOf(Textbook::class)
                ->that($this->content)->notEmpty()
                ->that($this->uuid)->isInstanceOf(UuidInterface::class)
                ->verifyNow();
        } catch (LazyAssertionException $exception) {
            throw new InvalidTextBookNoteException($exception->getMessage());
        }
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getTextbook(): Textbook
    {
        return $this->textbook;
    }




}
