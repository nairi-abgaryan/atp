<?php

namespace App\Entity;

use App\Entity\Base\ImageEntity;
use App\Entity\Base\TimestampableEntity;
use App\Entity\Base\TitleEntityVirtual;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 * @ORM\Table(name="videos")
 */
class Video
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
    private $link;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\VideoLang",
     *     mappedBy="videosContent",
     *     cascade={"persist", "remove"},
     *     fetch="EAGER",
     *     orphanRemoval=true
     * )
     */
    public $entityLang;

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

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @param VideoLang $entityLang
     */
    public function addEntityLang(VideoLang $entityLang): void
    {
        $entityLang->setVideosContent($this);
        $this->entityLang->set(0, $entityLang);
    }
}
