<?php

namespace MatCaps\Beta\Domain\Tests\TextBook;

use DateInterval;
use DateTimeImmutable;
use LogicException;
use MatCaps\Beta\Domain\Entity\Generics\Course;
use MatCaps\Beta\Domain\Entity\Generics\SchoolClass;
use MatCaps\Beta\Domain\Entity\TextBook\Textbook;
use MatCaps\Beta\Domain\Gateway\TextBook\TextBookGateway;
use MatCaps\Beta\Domain\Request\TextBook\DeleteTextBookRequest;
use MatCaps\Beta\Domain\Tests\TextBook\Repository\TextBookRepository;
use MatCaps\Beta\Domain\UseCase\TextBook\DeleteTextBook;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class DeleteTextBookTest extends TestCase
{
    private Textbook $textBook;
    private UuidInterface $uuid;
    private SchoolClass $schoolClass;
    private TextBookGateway $textBookRepository;

    protected function setUp(): void
    {
        $this->uuid = Uuid::uuid4();
        $this->schoolClass = new SchoolClass();
        $this->textBookRepository = new TextBookRepository();
        $this->textBook = new Textbook(
            $this->uuid->toString(),
            "this is the textbook content",
            (new DateTimeImmutable())->add(new DateInterval("P1W")),
            new Course(),
            $this->schoolClass
        );
    }

    public function testDeleteUnsharedTextBook(): void
    {
        //init repository with one textbook
        $this->textBookRepository->add($this->textBook);

        $request = new DeleteTextBookRequest($this->textBook);
        $useCase = new DeleteTextBook($request, $this->textBookRepository);

        $result = $useCase();

        self::assertCount(0, $this->textBookRepository->findAll());
        self::assertTrue($result);
    }

    public function testDeleteSharedTextBook(): void
    {
        $this->expectException(LogicException::class);

        //init shared repository with an already shared textbook;
        $this->textBook->share();

        self::assertTrue($this->textBook->isShared());

        $request = new DeleteTextBookRequest($this->textBook);
        $useCase = new DeleteTextBook($request, $this->textBookRepository);

        $result = $useCase();
    }
}
