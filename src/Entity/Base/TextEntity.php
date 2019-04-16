<?php

namespace App\Entity\Base;

/**
 * Trait TextEntity
 * @package App\Entity\Base
 */
trait TextEntity
{
    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $text;

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }
}