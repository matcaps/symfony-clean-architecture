<?php


namespace MatCaps\Beta\Domain\Entity;


/**
 * Class Todo
 * @package MatCaps\Beta\Domain\Entity
 */
class Todo
{
    /** @var string  */
    private string $content;
    /** @var bool  */
    private bool $done = false;

    /**
     * Todo constructor.
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return bool
     */
    public function isDone(): bool
    {
        return $this->done;
    }






}