<?php

namespace MatCaps\Beta\Domain\Request\TextBook;

/**
 * Class ShareTextBookRequest
 * @package MatCaps\Beta\Domain\Request\TextBook
 */
class ShareTextBookRequest
{
    private string $textBookId;
    private string $schoolClassId;

    /**
     * ShareTextBookRequest constructor.
     * @param string $textBookId
     * @param string $schoolClassId
     */
    public function __construct(string $textBookId, string $schoolClassId)
    {
        $this->textBookId = $textBookId;
        $this->schoolClassId = $schoolClassId;
    }

    /**
     * @return string
     */
    public function getTextBookId(): string
    {
        return $this->textBookId;
    }

    /**
     * @return string
     */
    public function getSchoolClassId(): string
    {
        return $this->schoolClassId;
    }
}
