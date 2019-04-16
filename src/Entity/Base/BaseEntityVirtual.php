<?php

namespace App\Entity\Base;

use JMS\Serializer\Annotation as Serializer;

/**
 * Trait BaseEntityVirtual
 * @package App\Entity\Base
 * @Serializer\VirtualProperty(
 *     "title",
 *     exp="this.getOwner()->getTitle",
 *     options={@Serializer\SerializedName("sName")}
 *  )
 */
trait BaseEntityVirtual
{
    use BaseVirtual;

    /**
     * @var string
     * @Serializer\Expose()
     */
    public $title;

    /**
     * @var string
     */
    public $text;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->checkValueExist($this->title);
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->checkValueExist($this->text);
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @param string $text
     */
    public function setText(string $text)
    {
        $this->text = $text;
    }
}
