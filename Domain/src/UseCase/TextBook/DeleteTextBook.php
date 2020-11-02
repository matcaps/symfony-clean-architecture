<?php

namespace MatCaps\Beta\Domain\UseCase\TextBook;

use LogicException;
use MatCaps\Beta\Domain\Gateway\TextBook\TextBookGateway;
use MatCaps\Beta\Domain\Request\TextBook\DeleteTextBookRequest;

class DeleteTextBook
{
    private DeleteTextBookRequest $request;
    private TextBookGateway $textBookRepository;

    public function __construct(DeleteTextBookRequest $request, TextBookGateway $textBookRepository)
    {
        $this->request = $request;
        $this->textBookRepository = $textBookRepository;
    }

    public function __invoke(): bool
    {
        $textbook = $this->request->getTextbook();

        if ($textbook->isShared()) {
            throw new LogicException("A Textbook cannot be deleted as far is shared");
        }

        $this->textBookRepository->remove($textbook);

        return true;
    }
}
