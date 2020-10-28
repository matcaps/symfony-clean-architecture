<?php

namespace MatCaps\Beta\Domain\UseCase\TextBook;

use MatCaps\Beta\Domain\Gateway\TextBook\SharedTextBookGateway;
use MatCaps\Beta\Domain\Gateway\TextBook\TextBookGateway;
use MatCaps\Beta\Domain\Request\TextBook\ShareTextBookRequest;

class ShareTextBook
{
    private ShareTextBookRequest $request;
    private TextBookGateway $textBookGateway;
    private SharedTextBookGateway $sharedTextBookGateway;

    /**
     * ShareTextBook constructor.
     * @param ShareTextBookRequest $request
     * @param TextBookGateway $textBookGateway
     * @param SharedTextBookGateway $sharedTextBookGateway
     */
    public function __construct(
        ShareTextBookRequest $request,
        TextBookGateway $textBookGateway,
        SharedTextBookGateway $sharedTextBookGateway
    ) {
        $this->request = $request;
        $this->textBookGateway = $textBookGateway;
        $this->sharedTextBookGateway = $sharedTextBookGateway;
    }

    public function execute(): void
    {
        $id = $this->request->getTextBookId();
        $textbook = $this->textBookGateway->findById($id);

        $textbook->shareWithSchoolClass($this->request->getSchoolClassId());
    }
}
