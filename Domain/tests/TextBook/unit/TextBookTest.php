<?php

namespace MatCaps\Beta\Domain\UseCase\TextBook\unit;

use DateInterval;
use DateTimeImmutable;
use DateTimeInterface;
use LogicException;
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
    private Textbook $textBook;
    private string $content;

    protected function setUp(): void
    {
        $schoolClass = new SchoolClass();
        $course = new Course();
        $this->content = "This is a test content";

        $this->textBook = new Textbook(
            Uuid::uuid4(),
            $this->content,
            (new DateTimeImmutable())->add(new DateInterval("P1W")),
            $course,
            $schoolClass
        );
    }

    public function testShouldReturnAnObjectFromTextbook(): void
    {
        assertInstanceOf(Textbook::class, $this->textBook);
        assertInstanceOf(SchoolClass::class, $this->textBook->getSchoolClass());
        assertInstanceOf(Course::class, $this->textBook->getCourse());
        assertInstanceOf(DateTimeInterface::class, $this->textBook->getDueAt());
        assertSame($this->content, $this->textBook->getContent());
    }

    public function textCreatingTextBookWithPastDate(): void
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

    public function testSharing(): void
    {
        self::assertFalse($this->textBook->isShared());
        $this->textBook->share();
        self::assertTrue($this->textBook->isShared());
    }

    /**
     * @depends testSharing
     */
    public function testAlreadySharedException(): void
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage("Textbook cannot be shared if already shared");

        //Test to share one more time an already shared textbook
        $this->textBook->share();
        $this->textBook->share();

        self::assertTrue($this->textBook->isShared());
    }
}
