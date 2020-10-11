<?php

namespace MatCaps\Beta\Domain\Response;

class TodoListResponse
{
    private array $todos;

    /**
     * TodoListResponse constructor.
     */
    public function __construct(array $todos)
    {
        $this->todos = $todos;
    }

    public function getTodos(): array
    {
        return $this->todos;
    }
}
