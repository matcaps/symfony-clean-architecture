<?php

use MatCaps\Beta\Domain\Entity\Todo;

use function PHPUnit\Framework\assertTrue;
use function PHPUnit\Framework\assertFalse;

it(
    "has an todo object that should be identifiable as late",
    function () {
        $yesterday = (new DateTimeImmutable)->sub(new DateInterval("P1D"));
        $todo = new Todo("My todo late todo", $yesterday);

        assertTrue($todo->isLate());
    }
);

it(
    "should return false if a todo object hasn't a due Date",
    function () {
        $todo = new Todo("My todo without end date");
        assertFalse($todo->isLate());
    }
);
