<?php

namespace MatCaps\Beta\Domain\UseCase\TextBook;

use MatCaps\Beta\Domain\Entity\Generics\SchoolClass;
use MatCaps\Beta\Domain\Gateway\TextBook\TextBookGateway;
use MatCaps\Beta\Domain\Presenter\TextBook\ShareTextBookPresenterInterface;
use MatCaps\Beta\Domain\Request\TextBook\ShareTextBookRequest;
use MatCaps\Beta\Domain\Response\TextBook\ShareTextBookResponse;

class ShareTextBook
{
    private ShareTextBookRequest $request;
    private TextBookGateway $textBookGateway;
    private SchoolClass $schoolClass;
    private ShareTextBookPresenterInterface $presenter;

    public function __construct(
        ShareTextBookRequest $request,
        TextBookGateway $textBookGateway,
        ShareTextBookPresenterInterface $presenter
    ) {
        $this->request = $request;
        $this->textBookGateway = $textBookGateway;
        $this->presenter = $presenter;
    }

    public function __invoke(): void
    {
        $this->textBookGateway->add($this->request->getTextBook());
        $this->request->getTextBook()->share();
        $this->textBookGateway->update($this->request->getTextBook());

        $sharedTextBookEntries = $this->textBookGateway->findAllSharedWith($this->request->getSchoolClass());

        $this->presenter->present(new ShareTextBookResponse($sharedTextBookEntries));
    }
}
