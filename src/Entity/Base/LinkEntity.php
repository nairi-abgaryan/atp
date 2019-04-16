<?php

namespace App\Entity\Base;

/**
 * Class LinkEntity
 * @package App\Entity\Base
 */
trait LinkEntity
{
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $linkText;

    /**
     * @return string
     */
    public function getLinkText()
    {
        return $this->linkText;
    }

    /**
     * @param string $linkText
     */
    public function setLinkText($linkText)
    {
        $this->linkText = $linkText;
    }
}