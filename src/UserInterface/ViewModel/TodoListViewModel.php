<?php


namespace App\UserInterface\ViewModel;

use MatCaps\Beta\Domain\Entity\Todo;

class TodoListViewModel
{
    private array $todos;

    /**
     * TodoListViewModel constructor.
     * @param Todo[] $todos
     */
    public function __construct(array $todos)
    {
        $this->todos = $todos;
    }

    /**
     * @return string[]
     */
    public function getTodos(): array
    {
        return $this->todos;
    }
}
