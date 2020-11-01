<?php

namespace MatCaps\Beta\Domain\UseCase\TextBook;

use MatCaps\Beta\Domain\Entity\TextBook\Textbook;
use MatCaps\Beta\Domain\Gateway\TextBook\TextBookGateway;
use MatCaps\Beta\Domain\Presenter\TextBook\CreateTextBookPresenterInterface;
use MatCaps\Beta\Domain\Request\TextBook\AddTextBookRequest;
use MatCaps\Beta\Domain\Response\TextBook\AddTextBookResponse;

class CreateTextBook
{

    private TextBookGateway $textBookGateway;

    /**
     * CreateTextBook constructor.
     * @param TextBookGateway $textBookGateway
     */
    public function __construct(TextBookGateway $textBookGateway)
    {
        $this->textBookGateway = $textBookGateway;
    }


    public function execute(
        AddTextBookRequest $request,
        CreateTextBookPresenterInterface $presenter
    ): void {

        $textBookEntry = TextBook::fromAddRequest($request);
        $this->textBookGateway->add($textBookEntry);

        $textBookEntry = $this->textBookGateway->findById($textBookEntry->getId());

        $presenter->present(new AddTextBookResponse($textBookEntry));
    }
}
