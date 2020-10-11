<?php

namespace App\UserInterface\Controller;

use App\UserInterface\Presenter\TodoListPresenter;
use MatCaps\Beta\Domain\UseCase\TodoList;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TodoListController
{
    /**
     * @Route("/todos" , methods={"GET"}, name="todos_collection_get")
     *
     * @param TodoList $todoList
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function __invoke(TodoList $todoList, SerializerInterface $serializer): JsonResponse
    {
        $todoListPresenter = new TodoListPresenter();

        $todoList->execute($todoListPresenter);

        return new JsonResponse(
            $serializer->serialize($todoListPresenter->getTodosViewModel(), 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
