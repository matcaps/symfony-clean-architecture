<?php

#devrait renvoyer la liste des todos qui doivent être cloturés le jour meme
#devrait renvoyer la liste des todos qui doivent etre terminés le jour même ou précédemment

use App\Infrastructure\Ports\Secondary\TodosRepository;
use MatCaps\Beta\Domain\Entity\Todo;

use function PHPUnit\Framework\assertCount;

it("should present a list of 10 todos which should be closed today",
    function (TodosRepository $repo) {
        $todos = $repo->findAllDueToday();
        assertCount(10, $todos);
    }
)->with([todoFromTodayRepositoryProvider()]);

it("should not find todos which have to be closed today",
    function (TodosRepository $repo) {
        $todos = $repo->findAllDueToday();
        assertCount(0, $todos);
    }
)->with([todoFromAfterTodayRepositoryProvider()]);

function todoFromTodayRepositoryProvider()
{
    $repo = new TodosRepository();

    for ($i = 1; $i < 11; $i++) {
        $todo = new Todo("Todo message {$i}", new DateTimeImmutable());
        $repo->add($todo);
    }

    return $repo;
}

function todoFromAfterTodayRepositoryProvider()
{
    $repo = new TodosRepository();

    for ($i = 1; $i < 11; $i++) {
        $todo = new Todo("Todo message {$i}", (new DateTimeImmutable())->add(new DateInterval("P2D")));
        $repo->add($todo);
    }

    return $repo;
}
