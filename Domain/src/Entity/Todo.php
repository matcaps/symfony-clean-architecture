<?php

namespace MatCaps\Beta\Domain\Entity;

use DateTimeImmutable;
use DateTimeInterface;

use function uniqid;

/**
 * Class Todo.
 */
class Todo
{
    /** @var string */
    private string $content;
    /** @var bool */
    private bool $done = false;
    /** @var DateTimeInterface|null */
    private ?DateTimeInterface $dueAt;
    /** @var string */
    private string $id;

    /**
     * Todo constructor.
     * @param string $content
     * @param DateTimeInterface|null $dueAt
     */
    public function __construct(string $content, ?DateTimeInterface $dueAt = null, $done = false)
    {
        $this->content = $content;
        $this->dueAt = $dueAt;
        $this->done = $done;
        $this->id = uniqid('todo', true);
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function isDone(): bool
    {
        return $this->done;
    }

    /**
     * @return DateTimeInterface|null
     * @Coverage
     */
    public function getDueAt(): ?DateTimeInterface
    {
        return $this->dueAt;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function toggleDoneStatus(): void
    {
        $this->done = !$this->done;
    }

    public function isLate(): bool
    {
        if ($this->dueAt === null) {
            return false;
        }

        return $this->dueAt < new DateTimeImmutable();
    }
}
