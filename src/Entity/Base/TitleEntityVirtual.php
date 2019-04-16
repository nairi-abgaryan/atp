<?php

namespace App\Entity\Base;

/**
 * Trait TitleEntityVirtual
 * @package App\Entity\Base
 */
trait TitleEntityVirtual
{
    /**
     * @var string
     */
    private $title;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->checkValueExist($this->title);
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
