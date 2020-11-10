<?php

namespace MatCaps\Beta\Domain\UseCase\TextBook;

use LogicException;
use MatCaps\Beta\Domain\Command\TextBook\TextBookNoteCommandInterface;
use MatCaps\Beta\Domain\Entity\TextBook\TextBookNote;
use MatCaps\Beta\Domain\Gateway\TextBook\TextBookNoteGateway;
use MatCaps\Beta\Domain\Presenter\TextBook\TextbookAddNotePresenterInterface;
use MatCaps\Beta\Domain\Request\TextBook\AddNoteToTextBookRequest;
use MatCaps\Beta\Domain\Response\TextBook\AddNoteToTextBookResponse;

class AddNoteToTextBook
{
    private AddNoteToTextBookRequest $request;
    private TextbookAddNotePresenterInterface $presenter;
    private TextBookNoteGateway $textBookNoteGateway;
    private TextBookNoteGateway $gateway;



    public function __construct(
        AddNoteToTextBookRequest $request,
        TextbookAddNotePresenterInterface $presenter,
        TextBookNoteGateway $gateway
    ) {
        $this->request = $request;
        $this->presenter = $presenter;
        $this->gateway = $gateway;
    }

    public function __invoke(): void
    {
        if (!$this->request->getTextbook()->isShared()) {
            throw new LogicException("Cannot add a note to an unshared textbook entry");
        }

        $note = TextBookNote::fromAddRequest($this->request);
        $this->gateway->save($note);

        $textBookNoteEntry = $this->gateway->findById($note->getId());

        if (null === $textBookNoteEntry) {
            throw new \RuntimeException("TextBookEntry cannot be null");
        }
        $this->presenter->present(new AddNoteToTextBookResponse($textBookNoteEntry));
    }
}
