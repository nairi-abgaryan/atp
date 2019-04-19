<?php

namespace App\Entity;

use App\Entity\Base\LangEntity;
use App\Entity\Base\TitleEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VideoLangRepository")
 * @ORM\Table(name="videosLang")
 */
class VideoLang
{
    use TitleEntity, LangEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Video
     * @ORM\ManyToOne(targetEntity="App\Entity\Video", inversedBy="entityLang")
     */
    private $video;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param Video $video
     */
    public function setVideo(Video $video): void
    {
        $this->video = $video;
    }
}
