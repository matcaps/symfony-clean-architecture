<?php


namespace App\UserInterface\ViewModel;

use MatCaps\Beta\Domain\Entity\Todo;

class TodoListViewModel
{
    /** @var Todo[]  */
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
     * @return Todo[]
     */
    public function getTodos(): array
    {
        return $this->todos;
    }
}
