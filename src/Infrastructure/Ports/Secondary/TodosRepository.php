<?php


namespace App\Infrastructure\Ports\Secondary;

use MatCaps\Beta\Domain\Entity\Todo;
use MatCaps\Beta\Domain\Gateway\TodoListGateway;

/**
 * Class TodosRepository
 * @package App\Infrastructure\Ports\Secondary
 */
class TodosRepository implements TodoListGateway
{
    /** @var array */
    private array $repository = [];

    /**
     * @return array
     */
    public function findAll()
    {
        return array_fill(0, 20, new Todo('Todo xxx'));
    }

    /**
     * @param Todo $todo
     */
    public function add(Todo $todo)
    {
        $this->repository[$todo->getId()] = $todo;
    }

    /**
     * @return int
     */
    public function getCurrentCount()
    {
        return count($this->repository);
    }

    /**
     * @param string $id
     * @return Todo|null
     */
    public function findById(string $id): ?Todo
    {
        return $this->repository[$id];
    }
}
