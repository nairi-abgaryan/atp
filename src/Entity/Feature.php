<?php

namespace App\Entity;

use App\Entity\Base\BaseVirtual;
use App\Entity\Base\ImageEntity;
use App\Entity\Base\TimestampableEntity;
use App\Entity\Base\TitleEntityVirtual;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FeatureRepository")
 * @ORM\Table(name="features")
 * @Vich\Uploadable
 */
class Feature
{
    use TitleEntityVirtual, ImageEntity, TimestampableEntity, BaseVirtual;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $linkType;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $position;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $order;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\FeatureLang",
     *     mappedBy="feature",
     *     cascade={"persist", "remove"},
     *     fetch="EXTRA_LAZY",
     *     orphanRemoval=true
     * )
     */
    public $entityLang;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\Page")
     */
    public $pages;


    public function __construct()
    {
        $this->entityLang = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getLinkType()
    {
        return $this->linkType;
    }

    public function setLinkType( $linkType)
    {
        $this->linkType = $linkType;

        return $this;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @param FeatureLang $entityLang
     */
    public function addEntityLang(FeatureLang $entityLang): void
    {
        $entityLang->setFeature($this);
        $this->entityLang->set(0, $entityLang);
    }
}
