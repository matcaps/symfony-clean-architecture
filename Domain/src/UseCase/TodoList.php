<?php

namespace MatCaps\Beta\Domain\UseCase;


use MatCaps\Beta\Domain\Gateway\TodoListGateway;
use MatCaps\Beta\Domain\Presenter\TodoListPresenterInterface;
use MatCaps\Beta\Domain\Request\TodoListRequest;
use MatCaps\Beta\Domain\Response\TodoListResponse;

/**
 * Class TodoList
 * @package MatCaps\Beta\Domain\UseCase
 */
class TodoList
{
    private TodoListGateway $todoListGateway;

    /**
     * TodoList constructor.
     * @param TodoListGateway $todoListGateway
     */
    public function __construct(TodoListGateway $todoListGateway)
    {
        $this->todoListGateway = $todoListGateway;
    }

    /**
     * @param TodoListRequest $todoListRequest
     * @param TodoListPresenterInterface $presenter
     */
    public function execute(TodoListRequest $todoListRequest , TodoListPresenterInterface $presenter): void
    {
        $presenter->present(new TodoListResponse($this->todoListGateway->findAll()));
    }

}