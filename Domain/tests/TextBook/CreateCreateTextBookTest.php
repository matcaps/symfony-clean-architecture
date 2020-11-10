<?php

namespace MatCaps\Beta\Domain\Tests\TextBook;

use DateInterval;
use DateTimeImmutable;
use DateTimeInterface;
use Exception;
use Generator;
use MatCaps\Beta\Domain\Entity\Generics\Course;
use MatCaps\Beta\Domain\Entity\Generics\SchoolClass;
use MatCaps\Beta\Domain\Exception\TextBook\InvalidTextBookException;
use MatCaps\Beta\Domain\Gateway\TextBook\TextBookGateway;
use MatCaps\Beta\Domain\Presenter\TextBook\CreateTextBookPresenterInterface;
use MatCaps\Beta\Domain\Request\TextBook\AddTextBookRequest;
use MatCaps\Beta\Domain\Response\TextBook\AddTextBookResponse;
use MatCaps\Beta\Domain\Tests\TextBook\Repository\TextBookRepository;
use MatCaps\Beta\Domain\UseCase\TextBook\CreateTextBook;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Rfc4122\Validator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class CreateCreateTextBookTest extends TestCase
{
    private CreateTextBook $useCase;
    private Course $course;
    private SchoolClass $schoolClass;
    private CreateTextBookPresenterInterface $presenter;
    private TextBookGateway $repository;


    protected function setUp(): void
    {
        $this->course = new Course();
        $this->schoolClass = new SchoolClass();
        $this->repository = new TextBookRepository();

        $this->presenter = new class implements CreateTextBookPresenterInterface {
            public AddTextBookResponse $response;

            public function present(AddTextBookResponse $response): void
            {
                $this->response = $response;
            }
        };
        $this->useCase = new CreateTextBook($this->repository);
    }

    public function testSuccessfulAddATextBook(): void
    {
        $uuid = Uuid::uuid4();
        $due = (new DateTimeImmutable())->add(new DateInterval("P1W"));

        $request = AddTextBookRequest::create(
            $uuid,
            "this is my textbook content",
            $due,
            new Course(),
            new SchoolClass()
        );

        $this->useCase->execute($request, $this->presenter);

        self::assertInstanceOf(AddTextBookResponse::class, $this->presenter->response);
        self::assertTrue((new Validator())->validate($this->presenter->response->getId()));
        self::assertSame($uuid->toString(), $this->presenter->response->getId());
        self::assertSame("this is my textbook content", $this->presenter->response->getContent());
        self::assertSame($due, $this->presenter->response->getDueAt());
        self::assertFalse($this->presenter->response->isShared());
    }

    /**
     * @param UuidInterface $id
     * @param string $content
     * @param DateTimeInterface $dueAt
     * @param Course $course
     * @param SchoolClass $schoolClass
     * @param string $message
     */
    public function testErrorWhenAddingATextbook(
        UuidInterface $id,
        string $content,
        DateTimeInterface $dueAt,
        Course $course,
        SchoolClass $schoolClass,
        string $message
    ): void {
        $this->expectException(InvalidTextBookException::class);
        $this->expectExceptionMessage($message);

        $request = AddTextBookRequest::create(
            $id,
            $content,
            $dueAt,
            $course,
            $schoolClass
        );

        $this->useCase->execute($request, $this->presenter);
    }

    /**
     * @return Generator<array>
     */
    public function provideInvalidData(): Generator
    {
        yield [
            Uuid::uuid4(),
            "",
            (new DateTimeImmutable())->add(new DateInterval("P1D")),
            new Course(),
            new SchoolClass(),
            "Content cannot be null"
        ];
        yield [
            Uuid::uuid4(),
            "content",
            (new DateTimeImmutable())->sub(new DateInterval("P1D")),
            new Course(),
            new SchoolClass(),
            "Date cannot be in the past"
        ];
    }
}
