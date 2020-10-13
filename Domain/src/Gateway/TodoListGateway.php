<?php

namespace MatCaps\Beta\Domain\Gateway;

use MatCaps\Beta\Domain\Entity\Todo;

interface TodoListGateway
{
    public function findAll();

    public function add(Todo $todo);

    public function getCurrentCount();

    public function findOneBy(array $pairs) : ?Todo;

    public function findBy(array $pair): array;
}
