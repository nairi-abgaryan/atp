<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Base\ImageEntity;
use App\Entity\Base\TimestampableEntity;
use App\Entity\Base\TitleEntityVirtual;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EcoGameRepository")
 * @ORM\Table(name="ecoGames")
 * @Vich\Uploadable
 */
class EcoGame
{
    use TitleEntityVirtual, ImageEntity, TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $path;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\EcogamesLang",
     *     mappedBy="ecogames",
     *     cascade={"persist", "remove"},
     *     fetch="EAGER",
     *     orphanRemoval=true
     * )
     */
    public $entityLang;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getEntityLang()
    {
        return $this->entityLang;
    }

    /**
     * @param ArrayCollection $entityLang
     */
    public function setEntityLang(ArrayCollection $entityLang): void
    {
        $this->entityLang = $entityLang;
    }

    /**
     * @param EcoGameLang $entityLang
     */
    public function addEntityLang(EcoGameLang $entityLang): void
    {
        $entityLang->setEcoGame($this);
        $this->entityLang->set(0, $entityLang);
    }
}
