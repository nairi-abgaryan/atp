<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\Base\TextEntityVirtual;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamBranchRepository")
 * @ORM\Table(name="team_branches")
 * @Vich\Uploadable
 */
class TeamBranch
{

    use TextEntityVirtual;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $type;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\TeamBranchLang",
     *     mappedBy="teamBranches",
     *     cascade={"persist", "remove"},
     *     fetch="EAGER",
     *     orphanRemoval=true
     * )
     */
    public $entityLang;

    public function __toString() {
        return $this->getText();
    }

    public function __construct()
    {
        $this->entityLang = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param TeamBranchLang $entityLang
     */
    public function addEntityLang(TeamBranchLang $entityLang): void
    {
        $entityLang->setTeamBranch($this);
        $this->entityLang->set(0, $entityLang);
    }
}
