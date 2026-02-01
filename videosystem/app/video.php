<?php
class Video
{
    public function __construct(
        private string $publicationDate,
    )
    {}

    public function informations():string
    {
        return $this->publicationDate;
    }
}
?>