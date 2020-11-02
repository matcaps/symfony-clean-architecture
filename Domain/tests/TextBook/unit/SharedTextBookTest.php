<?php

namespace MatCaps\Beta\Domain\Tests\TextBook\unit;

use DateInterval;
use DateTimeImmutable;
use MatCaps\Beta\Domain\Entity\Generics\Course;
use MatCaps\Beta\Domain\Entity\Generics\SchoolClass;
use MatCaps\Beta\Domain\Entity\TextBook\SharedTextBook;
use MatCaps\Beta\Domain\Entity\TextBook\Textbook;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class SharedTextBookTest extends TestCase
{
    private UuidInterface $uuid;
    private SchoolClass $schoolClass;
    private Textbook $textBook;

    public function setUp(): void
    {
        $this->uuid = Uuid::uuid4();
        $this->schoolClass = new SchoolClass();
        $this->textBook = new Textbook(
            $this->uuid->toString(),
            "this is content to share to all student",
            (new DateTimeImmutable())->add(new DateInterval("P1W")),
            new Course(),
            $this->schoolClass
        );
    }

    public function testShouldReturnAnSharedTextBookObject(): void
    {
        $sharedTextBook = new SharedTextBook($this->textBook, $this->schoolClass);

        self::assertInstanceOf(SharedTextBook::class, $sharedTextBook);
        self::assertInstanceOf(TextBook::class, $sharedTextBook->getTextBook());
        self::assertInstanceOf(SchoolClass::class, $sharedTextBook->getSchoolClass());
    }
}
