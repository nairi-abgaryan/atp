<?php

namespace App\Entity\Base;

/**
 * Class LinkEntityVirtual
 * @package App\Entity\Base
 */
trait LinkEntityVirtual
{
    use BaseVirtual;

    /**
     * @var string
     */
    private $linkText;

    /**
     * @return string
     * @var mixed $this->lang
     */
    public function getLinkText()
    {
        return $this->checkValueExist($this->linkText);
    }

    /**
     * @param string $linkText
     */
    public function setLinkText(string $linkText): void
    {
        $this->linkText = $linkText;
    }
}