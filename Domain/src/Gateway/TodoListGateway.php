<?php

namespace MatCaps\Beta\Domain\Gateway;

use MatCaps\Beta\Domain\Entity\Todo;

interface TodoListGateway
{
    public function findAll();

    public function add(Todo $todo);

    public function getCurrentCount();
}
