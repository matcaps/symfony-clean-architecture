<?php

namespace MatCaps\Beta\Domain\UseCase\TextBook\unit;

use DateInterval;
use DateTimeImmutable;
use DateTimeInterface;
use MatCaps\Beta\Domain\Entity\Generics\Course;
use MatCaps\Beta\Domain\Entity\Generics\SchoolClass;
use MatCaps\Beta\Domain\Entity\TextBook\Textbook;
use MatCaps\Beta\Domain\Exception\TextBook\InvalidTextBookException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertInstanceOf;
use function it;
use function uses;

class TextBookTest extends TestCase
{
    public function testShouldReturnAnObjectFromTextbook(): void
    {
        $schoolClass = new SchoolClass();
        $course = new Course();
        $content  = "This is a test content";

        $textBook = new Textbook(
            Uuid::uuid4(),
            $content,
            (new DateTimeImmutable())->add(new DateInterval("P1W")),
            $course,
            $schoolClass
        );

        assertInstanceOf(Textbook::class, $textBook);
        assertInstanceOf(SchoolClass::class, $textBook->getSchoolClass());
        assertInstanceOf(Course::class, $textBook->getCourse());
        assertInstanceOf(DateTimeInterface::class, $textBook->getDueAt());
        assertSame($content, $textBook->getContent());
    }

    public function shouldThrowAnInvalidTextBookDateException(): void
    {
        $this->expectException(InvalidTextBookException::class);

        $schoolClass = new SchoolClass();
        $course = new Course();

        $textBook = new Textbook(
            Uuid::uuid4(),
            "This is a test content",
            (new DateTimeImmutable())->sub(new DateInterval("P1W")),
            $course,
            $schoolClass
        );
    }
}
