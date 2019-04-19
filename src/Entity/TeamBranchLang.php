<?php

namespace App\Entity;

use App\Entity\Base\LangEntity;
use App\Entity\Base\TextEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamBranchLangRepository")
 */
class TeamBranchLang
{
    use TextEntity, LangEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var TeamBranch
     * @ORM\ManyToOne(targetEntity="App\Entity\Team\TeamBranches", inversedBy="entityLang")
     */
    private $teamBranch;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return TeamBranch
     */
    public function getTeamBranch()
    {
        return $this->teamBranch;
    }

    /**
     * @param TeamBranch $teamBranch
     */
    public function setTeamBranch(TeamBranch $teamBranch): void
    {
        $this->teamBranch = $teamBranch;
    }
}
