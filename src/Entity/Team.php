<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Base\ImageEntity;
use App\Entity\Base\TimestampableEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 * @ORM\Table(name="teams")
 * @Vich\Uploadable
 */
class Team
{
    use ImageEntity, TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $branch_id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TeamBranch")
     * @ORM\JoinColumn(name="branch_id", referencedColumnName="id", onDelete="cascade")
     */
    private $branches;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\TeamLang",
     *     mappedBy="teamMember",
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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     * @var mixed $this->lang
     */
    public function getName()
    {
        if ($this->entityLang && $this->entityLang->get(0)) {
            return $this->entityLang->get(0)->getName();
        }

        return null;
    }

    /**
     * @return string
     * @var mixed $this->lang
     */
    public function getPosition()
    {
        if ($this->entityLang && $this->entityLang->get(0)) {
            return $this->entityLang->get(0)->getPosition();
        }

        return null;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
        $this->entityLang[0]->setName($name);
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position): void
    {
        $this->position = $position;
        $this->entityLang[0]->setPosition($position);
    }

    public function getBranchId(): ?int
    {
        return $this->branch_id;
    }

    public function setBranchId(int $branch_id): self
    {
        $this->branch_id = $branch_id;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updatedAt = new \DateTime('now');
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

    public function getBranches()
    {
        return $this->branches;
    }

    public function setBranches($branches)
    {
        $this->branches = $branches;

        return $this;
    }

    /**
     * @param TeamLang $entityLang
     */
    public function addEntityLang(TeamLang $entityLang): void
    {
        $entityLang->setTeam($this);
        $this->entityLang->set(0, $entityLang);
    }
}
