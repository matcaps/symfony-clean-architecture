<?php

namespace MatCaps\Beta\Domain\Presenter;

use MatCaps\Beta\Domain\Response\TodoListResponse;

interface TodoListPresenterInterface
{
    public function present(TodoListResponse $response): void;
}
