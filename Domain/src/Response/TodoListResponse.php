<?php

namespace MatCaps\Beta\Domain\Response;

use MatCaps\Beta\Domain\Entity\Todo;

/**
 * Class TodoListResponse
 * @package MatCaps\Beta\Domain\Response
 */
class TodoListResponse
{
    /** @var array<Todo>  */
    private array $todos;

    /**
     * TodoListResponse constructor.
     * @param array<Todo> $todos
     */
    public function __construct(array $todos)
    {
        $this->todos = $todos;
    }

    /**
     * @return array<Todo>
     */
    public function getTodos(): array
    {
        return $this->todos;
    }
}
