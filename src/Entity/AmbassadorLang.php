<?php

namespace App\Entity;

use App\Entity\Base\LangEntity;
use App\Entity\Base\TextBottomEntity;
use App\Entity\Base\TextTopEntity;
use App\Entity\Base\TitleEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AmbassadorLangRepository")
 * @ORM\Table(name="ambassadorsLang")
 */
class AmbassadorLang
{
    use TitleEntity, TextBottomEntity, TextTopEntity, LangEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Ambassador
     * @ORM\ManyToOne(targetEntity="App\Entity\Ambassador", inversedBy="entityLang")
     */
    private $ambassador;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $textBottom;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Ambassador
     */
    public function getAmbassador()
    {
        return $this->ambassador;
    }

    /**
     * @param Ambassador $ambassador
     */
    public function setAmbassador(Ambassador $ambassador): void
    {
        $this->ambassador = $ambassador;
    }

    /**
     * @return string
     */
    public function getTextBottom()
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
