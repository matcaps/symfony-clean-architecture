<?php


namespace App\Infrastructure\Ports\Secondary;


use MatCaps\Beta\Domain\Entity\Todo;
use MatCaps\Beta\Domain\Gateway\TodoListGateway;

class TodosRepository implements TodoListGateway
{

    public function findAll()
    {
        return array_fill(0,20 , new Todo("Todo xxx"));
    }
}