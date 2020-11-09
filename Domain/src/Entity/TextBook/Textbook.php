<?php

namespace MatCaps\Beta\Domain\Entity\TextBook;

use DateInterval;
use DateTimeImmutable;
use DateTimeInterface;
use LogicException;
use MatCaps\Beta\Domain\Entity\Generics\Course;
use MatCaps\Beta\Domain\Entity\Generics\SchoolClass;
use MatCaps\Beta\Domain\Exception\TextBook\InvalidTextBookException;
use MatCaps\Beta\Domain\Request\TextBook\AddTextBookRequest;

class Textbook
{
    private string $id;
    private string $content;
    private DateTimeInterface $dueAt;
    private Course $course;
    private SchoolClass $schoolClass;
    private bool $isShared;

    public function __construct(
        string $id,
        string $content,
        DateTimeInterface $dueAt,
        Course $course,
        SchoolClass $schoolClass
    ) {
        if ($dueAt < (new DateTimeImmutable())->add(new DateInterval("P1D"))) {
            throw new InvalidTextBookException();
        }

        $this->id = $id;
        $this->content = $content;
        $this->dueAt = $dueAt;
        $this->course = $course;
        $this->schoolClass = $schoolClass;
        $this->isShared = false;
    }

    public static function fromAddRequest(AddTextBookRequest $request): self
    {
        return new self(
            $request->getId(),
            $request->getContent(),
            $request->getDueAt(),
            $request->getCourse(),
            $request->getSchoolClass()
        );
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

    public function isShared(): bool
    {
        return $this->isShared;
    }

    public function share(): void
    {
        if ($this->isShared) {
            throw new LogicException("Textbook cannot be shared if already shared");
        }

        $this->isShared = true;
    }
}
