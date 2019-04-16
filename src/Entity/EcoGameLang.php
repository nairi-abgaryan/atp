<?php

namespace App\Entity;

use App\Entity\Base\LangEntity;
use App\Entity\Base\TitleEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EcoGameLangRepository")
 * @ORM\Table(name="ecoGamesLang")
 */
class EcoGameLang
{
    use TitleEntity, LangEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Ecogame
     * @ORM\ManyToOne(targetEntity="App\Entity\Ecogame", inversedBy="entityLang")
     */
    private $ecoGame;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Ecogame
     */
    public function getEcoGame()
    {
        return $this->ecoGame;
    }

    /**
     * @param Ecogame $ecoGame
     */
    public function setEcoGame(Ecogame $ecoGame): void
    {
        $this->ecoGame = $ecoGame;
    }
}
