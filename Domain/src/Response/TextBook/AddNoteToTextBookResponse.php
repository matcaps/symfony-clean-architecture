<?php


namespace MatCaps\Beta\Domain\Response\TextBook;


use MatCaps\Beta\Domain\Entity\TextBook\TextBookNote;

class AddNoteToTextBookResponse
{
    private TextBookNote $note;

    public function __construct(TextBookNote $note)
    {
        $this->note = $note;
    }

    /**
     * @return TextBookNote
     */
    public function getNote(): TextBookNote
    {
        return $this->note;
    }


}
