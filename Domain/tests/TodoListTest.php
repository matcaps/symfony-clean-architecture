<?php

use App\Infrastructure\Ports\Secondary\TodosRepository;
use App\UserInterface\Presenter\TodoListPresenter;
use App\UserInterface\ViewModel\TodoListViewModel;
use MatCaps\Beta\Domain\UseCase\TodoList;

use function PHPUnit\Framework\assertInstanceOf;

it("should run execute method without error ", function () {

    $repo = new TodosRepository();
    $useCase = new TodoList($repo);

    $presenter = new TodoListPresenter();
    $useCase->execute($presenter);

    assertInstanceOf(TodoListViewModel::class, $presenter->getTodosViewModel());
});
