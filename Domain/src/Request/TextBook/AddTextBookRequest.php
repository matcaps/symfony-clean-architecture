<?php

namespace MatCaps\Beta\Domain\Request\TextBook;

use Assert\Assert;
use Assert\Assertion;
use Assert\LazyAssertionException;
use DateTimeImmutable;
use MatCaps\Beta\Domain\Entity\Generics\Course;
use MatCaps\Beta\Domain\Entity\Generics\SchoolClass;
use MatCaps\Beta\Domain\Entity\TextBook\Exception\InvalidTextBookDateException;
use Ramsey\Uuid\UuidInterface;

class AddTextBookRequest
{
    private UuidInterface $uuid4;
    private string $content;
    private \DateTimeInterface $dueAt;
    private Course $course;
    private SchoolClass $schoolClass;

    /**
     * AddTextBookRequest constructor.
     * @throws InvalidTextBookDateException
     */
    public function __construct(
        UuidInterface $uuid4,
        string $content,
        \DateTimeInterface $dueAt,
        Course $course,
        SchoolClass $schoolClass
    ) {
        $this->uuid4 = $uuid4;
        $this->content = $content;
        $this->dueAt = $dueAt;
        $this->course = $course;
        $this->schoolClass = $schoolClass;

        $this->validate();
    }

    /**
     * @throws InvalidTextBookDateException
     */
    protected function validate(): void
    {
        try {
            Assert::lazy()
                ->that($this->content)->notBlank("Content cannot be null")
                ->that($this->dueAt)->greaterThan(new DateTimeImmutable())
                ->verifyNow();
        } catch (LazyAssertionException $e) {
            throw new InvalidTextBookDateException($e->getMessage());
        }
    }

    public static function create(
        UuidInterface $uuid4,
        string $content,
        \DateTimeInterface $dueAt,
        Course $course,
        SchoolClass $schoolClass
    ): self {
        return new self($uuid4, $content, $dueAt, $course, $schoolClass);
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->uuid4;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDueAt(): \DateTimeInterface
    {
        return $this->dueAt;
    }

    /**
     * @return Course
     */
    public function getCourse(): Course
    {
        return $this->course;
    }

    /**
     * @return SchoolClass
     */
    public function getSchoolClass(): SchoolClass
    {
        return $this->schoolClass;
    }
}
