<?php

namespace MatCaps\Beta\Domain\UseCase;

use MatCaps\Beta\Domain\Entity\Todo;

/**
 * Class ToggleTodoStatus
 * @package MatCaps\Beta\Domain\UseCase
 */
class ToggleTodoStatus
{
    /** @var array<Todo>  */
    private array $unDoneTodo;

    /**
     * @param Todo $todo
     * @return Todo
     */
    public function execute(Todo $todo): Todo
    {

        $todo->toggleDoneStatus();
        return $todo;
    }
}
