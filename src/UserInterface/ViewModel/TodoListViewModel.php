<?php


namespace App\UserInterface\ViewModel;


class TodoListViewModel
{
    private array $todos = [];

    /**
     * TodoListViewModel constructor.
     * @param String[] $todos
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