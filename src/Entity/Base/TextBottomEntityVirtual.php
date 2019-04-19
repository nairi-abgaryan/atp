<?php

namespace App\Entity\Base;

/**
 * Trait TextBottomEntityVirtual
 * @package App\Entity\Base
 */
trait TextBottomEntityVirtual
{
    /**
     * @var string
     */
    private $textBottom;

    /**
     * @return string
     * @var mixed $this->lang
     */
    public function getTextBottom()
    {
        return $this->checkValueExist($this->textBottom);
    }

    /**
     * @param string $textBottom
     */
    public function setTextBottom(string $textBottom): void
    {
        $this->textBottom = $textBottom;
    }
}
