<?php

namespace App\Entity\Base;

/**
 * Class LangEntity
 * @package App\Entity\Base
 */
trait LangEntity
{
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true, length=3)
     */
    private $lang;

    /**
     * @return string
     */
    public function getLang(): string
    {
        return $this->lang;
    }

    /**
     * @param string $lang
     */
    public function setLang(string $lang): void
    {
        $this->lang = $lang;
    }
}