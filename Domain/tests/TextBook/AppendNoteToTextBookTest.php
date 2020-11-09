<?php

namespace MatCaps\Beta\Domain\Tests\TextBook;

use DateInterval;
use DateTimeImmutable;
use LogicException;
use MatCaps\Beta\Domain\Entity\Generics\Course;
use MatCaps\Beta\Domain\Entity\Generics\SchoolClass;
use MatCaps\Beta\Domain\Entity\TextBook\Textbook;
use MatCaps\Beta\Domain\Entity\TextBook\TextBookNote;
use MatCaps\Beta\Domain\Gateway\TextBook\TextBookNoteGateway;
use MatCaps\Beta\Domain\Presenter\TextBook\CreateTextBookPresenterInterface;
use MatCaps\Beta\Domain\Presenter\TextBook\TextbookAddNotePresenterInterface;
use MatCaps\Beta\Domain\Presenter\TextBook\TextbookAddPresenterInterface;
use MatCaps\Beta\Domain\Request\TextBook\AddNoteToTextBookRequest;
use MatCaps\Beta\Domain\Response\TextBook\AddNoteToTextBookResponse;
use MatCaps\Beta\Domain\Response\TextBook\AddTextBookResponse;
use MatCaps\Beta\Domain\Tests\TextBook\Repository\TextBookNoteRepository;
use MatCaps\Beta\Domain\UseCase\TextBook\AddNoteToTextBook;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class AppendNoteToTextBookTest extends TestCase
{
    private Textbook $textBook;
    private \Ramsey\Uuid\UuidInterface $uuid;
    private SchoolClass $schoolClass;
    private TextBookNote $textBookNote;
    private TextBookNoteGateway $textBookNoteGateway;

    /**
     * Tests :
     *  - ajouter une note à un textbook partagé
     *  - àjouter une note à un textbook non partagé : doit provoquer une erreur
     *  -
     */
    protected function setUp(): void
    {
        $this->uuid = Uuid::uuid4();
        $this->schoolClass = new SchoolClass();
        $this->textBookNoteGateway = new TextBookNoteRepository();
        $this->textBook = new Textbook(
            $this->uuid->toString(),
            "this is the textbook content",
            (new DateTimeImmutable())->add(new DateInterval("P1W")),
            new Course(),
            $this->schoolClass
        );
        $this->presenter = new class implements TextbookAddNotePresenterInterface {
            public AddNoteToTextBookResponse $response;

            public function present(AddNoteToTextBookResponse $response): void
            {
                $this->response = $response;
            }
        };
    }

    public function testSuccesfullyAppendNoteToSharedTextBook(): void
    {
        $this->textBook->share();

        $content = "Textbook note content";
        $request = AddNoteToTextBookRequest::create(
            Uuid::uuid4(),
            $content,
            $this->textBook
        );

        $useCase = new AddNoteToTextBook($request, $this->presenter, $this->textBookNoteGateway);
        $useCase();

        $response = $this->presenter->response;

        self::assertInstanceOf(AddNoteToTextBookResponse::class, $response);
        self::assertInstanceOf(TextBookNote::class, $response->getNote());
        self::assertSame($content, $response->getNote()->getContent());
    }

    public function testAddUnsuccessfullyNoteToUnsharedTextBook(): void
    {
        self::expectException(LogicException::class);
        self::expectExceptionMessage("Cannot add a note to an unshared textbook entry");

        $content = "Textbook note content";
        $request = AddNoteToTextBookRequest::create(
            Uuid::uuid4(),
            $content,
            $this->textBook
        );

        $useCase = new AddNoteToTextBook($request, $this->presenter, $this->textBookNoteGateway);
        $useCase();
    }
}
