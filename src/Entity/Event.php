<?php

namespace App\Entity;

use App\Entity\Base\BaseEntityVirtual;
use App\Entity\Base\ImageEntity;
use App\Entity\Base\TimestampableEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 * @ORM\Table(name="events")
 * @Vich\Uploadable
 */
class Event
{
    use BaseEntityVirtual, ImageEntity, TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\EventLang",
     *     mappedBy="events",
     *     cascade={"persist", "remove"},
     *     fetch="EAGER",
     *     orphanRemoval=true
     * )
     */
    public $entityLang;

    /**
     * EducationContentBottom constructor.
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
     * @param EventLang $entityLang
     */
    public function addEntityLang(EventLang $entityLang): void
    {
        $entityLang->setEvent($this);
        $this->entityLang->set(0, $entityLang);
    }
}
