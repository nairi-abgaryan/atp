<?php

namespace App\Entity\Base;

/**
 * Trait TitleEntity
 * @package App\Entity\Base
 */
trait TitleEntity
{
    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $title;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
}
