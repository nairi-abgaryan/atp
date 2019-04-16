<?php

namespace App\Entity;

use App\Entity\Base\BaseVirtual;
use App\Entity\Base\ImageEntity;
use App\Entity\Base\TextBottomEntityVirtual;
use App\Entity\Base\TextTopVirtualEntity;
use App\Entity\Base\TimestampableEntity;
use App\Entity\Base\TitleEntityVirtual;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AmbassadorRepository")
 * @ORM\Table(name="ambassadors")
 * @Vich\Uploadable
 */
class Ambassador
{
    use TitleEntityVirtual,
        TextBottomEntityVirtual,
        TextTopVirtualEntity,
        TimestampableEntity,
        ImageEntity,
        BaseVirtual;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\AmbassadorLang",
     *     mappedBy="ambassador",
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

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            try {
                $this->updatedAt = new \DateTime('now');
            } catch (\Exception $e) {
            }
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @param AmbassadorLang $entityLang
     */
    public function addEntityLang(AmbassadorLang $entityLang): void
    {
        $entityLang->setAmbassador($this);
        $this->entityLang->set(0, $entityLang);
    }
}
