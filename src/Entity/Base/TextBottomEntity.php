<?php

namespace App\Entity\Base;

/**
 * Trait TextBottomEntity
 * @package App\Entity\Base
 */
trait TextBottomEntity
{
    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $textBottom;

    /**
     * @return string
     */
    public function getTextBottom(): ?string
    {
        return $this->textBottom;
    }

    /**
     * @param string $textBottom
     */
    public function setTextBottom(string $textBottom): void
    {
        $this->textBottom = $textBottom;
    }
}
