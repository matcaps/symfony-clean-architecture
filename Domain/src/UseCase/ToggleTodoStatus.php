<?php

namespace MatCaps\Beta\Domain\UseCase;

use MatCaps\Beta\Domain\Entity\Todo;

class ToggleTodoStatus
{
    private array $unDoneTodo;

    public function execute(Todo $todo): Todo
    {

        $todo->toggleDoneStatus();
        return $todo;
    }
}
