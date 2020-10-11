<?php


namespace App\UserInterface\Presenter;

use App\UserInterface\ViewModel\TodoListViewModel;
use MatCaps\Beta\Domain\Entity\Todo;
use MatCaps\Beta\Domain\Presenter\TodoListPresenterInterface;
use MatCaps\Beta\Domain\Response\TodoListResponse;

class TodoListPresenter implements TodoListPresenterInterface
{
    /** @var TodoListViewModel  */
    private TodoListViewModel $todosViewModel;

    /**
     * @param TodoListResponse $response
     */
    public function present(TodoListResponse $response)
    {
        $this->todosViewModel = new TodoListViewModel(
            array_map(static fn(Todo $todo) => $todo->getContent(), $response->getTodos())
        );
    }

    /**
     * @return TodoListViewModel
     */
    public function getTodosViewModel(): TodoListViewModel
    {
        return $this->todosViewModel;
    }
}
