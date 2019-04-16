<?php

namespace App\Entity;

use App\Entity\Base\TextEntityVirtual;
use App\Entity\Base\ImageEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoRepository")
 * @ORM\Table(name="photos")
 * @Vich\Uploadable
 */
class Photo
{
    use TextEntityVirtual, ImageEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\Photo\PhotoLang",
     *     mappedBy="photo",
     *     cascade={"persist", "remove"},
     *     fetch="EAGER",
     *     orphanRemoval=true
     * )
     */
    public $entityLang;

    /**
     * @var Image[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Image", cascade={"persist"})
     * @ORM\JoinTable(name="photos_images",
     *      joinColumns={@ORM\JoinColumn(name="photo_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="image_id", referencedColumnName="id", unique=true)}
     * )
     */
    private $images;

    public function __toString()
    {
        return $this->getText();
    }

    /**
     * Country constructor.
     */
    public function __construct()
    {
        $this->entityLang = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Image[]|ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param Image[]|ArrayCollection $images
     */
    public function setImages($images): void
    {
        $this->images = $images;
    }

    /**
     * @param PhotoLang $entityLang
     */
    public function addEntityLang(PhotoLang $entityLang): void
    {
        $entityLang->setPhoto($this);
        $this->entityLang->set(0, $entityLang);
    }
}
