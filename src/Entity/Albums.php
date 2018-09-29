<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use App\Utils\TokenGenerator;
/**
 * @ORM\Entity(repositoryClass="App\Repository\AlbumsRepository")
 */
class Albums
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $artist_token;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cover;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    protected $tokensAllreadyUsed = array();

    public function __construct()
    {

        do {
            $token = TokenGenerator::generate(6);
        }  while (in_array($token, $this->tokensAllreadyUsed));
        
        $this->tokensAllreadyUsed[] = $token;
        $this->token = $token;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getArtistToken(): ?string
    {
        return $this->artist_token;
    }
    public function setArtistToken(?string $artist_token): self
    {
        $this->artist_token = $artist_token;
        return $this;
    }


}
