<?php

namespace App\Entity\Base;

/**
 * Trait TextTopEntity
 * @package App\Entity\Base
 */
trait TextTopVirtualEntity
{
    use BaseVirtual;

    /**
     * @var string
     */
    private $textTop;

    /**
     * @return string
     * @var mixed $this->lang
     */
    public function getTextTop()
    {
        return $this->checkValueExist($this->textTop);
    }

    /**
     * @param string $textTop
     */
    public function setTextTop(string $textTop): void
    {
        $this->textTop = $textTop;
    }
}
