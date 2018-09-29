<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SongsRepository")
 */
class Songs
{

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $album_token;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $length;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getLength(): ?int
    {
        return (int) ($this->length / 60);
    }

    public function setLength(string $length): self
    {
        list($minutes, $seconds) = explode(':', $length);
        $this->length = (int) (($minutes * 60) + $seconds);
        return $this;
    }

    public function getAlbumToken(): ?string
    {
        return $this->album_token;
    }

    public function setAlbumToken(?string $album_token): self
    {
        $this->album_token = $album_token;

        return $this;
    }




}
