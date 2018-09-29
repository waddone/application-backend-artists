<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Utils\TokenGenerator;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtistsRepository")
 */
class Artists
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=6)
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
}
