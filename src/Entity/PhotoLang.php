<?php

namespace App\Entity;

use App\Entity\Base\TextEntity;
use App\Entity\Base\LangEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoLangRepository")
 * @ORM\Table(name="photosLang")
 */
class PhotoLang
{
    use TextEntity, LangEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Photo
     * @ORM\ManyToOne(targetEntity="App\Entity\Photo", inversedBy="entityLang")
     */
    private $photo;

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
     * @return Photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param Photo $photo
     */
    public function setPhoto(Photo $photo): void
    {
        $this->photo = $photo;
    }
}
