<?php


namespace MatCaps\Beta\Domain\Response;


class TodoListResponse
{
    private array $todos;

    /**
     * TodoListResponse constructor.
     * @param array $todos
     */
    public function __construct(array $todos)
    {
        $this->todos = $todos;
    }

    /**
     * @return array
     */
    public function getTodos(): array
    {
        return $this->todos;
    }




}