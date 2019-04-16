<?php

namespace App\Entity;

use App\Entity\Base\LangEntity;
use App\Entity\Base\TitleEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FeatureLangRepository")
 * @ORM\Table(name="featuresLang")
 */
class FeatureLang
{
    use TitleEntity, LangEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Feature
     * @ORM\ManyToOne(targetEntity="App\Entity\Feature", inversedBy="entityLang")
     */
    private $feature;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Feature
     */
    public function getFeature()
    {
        return $this->feature;
    }

    /**
     * @param Feature $feature
     */
    public function setFeature(Feature $feature): void
    {
        $this->feature = $feature;
    }
}
