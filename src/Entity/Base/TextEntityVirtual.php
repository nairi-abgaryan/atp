<?php

namespace App\Entity\Base;

/**
 * Trait TextEntityVirtual
 * @package App\Entity\Base
 */
trait TextEntityVirtual
{
    use BaseVirtual;
    /**
     * @var string
     */
    private $text;

    /**
     * @return string
     * @var mixed $this->lang
     */
    public function getText()
    {
        return $this->checkValueExist($this->text);
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }
}