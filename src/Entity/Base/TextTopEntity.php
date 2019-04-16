<?php

namespace App\Entity\Base;

/**
 * Trait TextTopEntity
 * @package App\Entity\Base
 */
trait TextTopEntity
{
    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $textTop;

    /**
     * @return string
     */
    public function getTextTop(): ?string
    {
        return $this->textTop;
    }

    /**
     * @param string $textTop
     */
    public function setTextTop(string $textTop): void
    {
        $this->textTop = $textTop;
    }
}
