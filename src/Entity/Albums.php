<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlbumsRepository")
 */
class Albums
{
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     */
    private $token;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Songs", mappedBy="album")
     */
    private $songs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Artists", inversedBy="albums")
     */
    private $artists;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cover;

    public function __construct()
    {
        $this->songs = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
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

    /**
     * @return Collection|Songs[]
     */
    public function getSongs(): Collection
    {
        return $this->songs;
    }

    public function addSong(Songs $song): self
    {
        if (!$this->songs->contains($song)) {
            $this->songs[] = $song;
            $song->setAlbum($this);
        }

        return $this;
    }

    public function removeSong(Songs $song): self
    {
        if ($this->songs->contains($song)) {
            $this->songs->removeElement($song);
            // set the owning side to null (unless already changed)
            if ($song->getAlbum() === $this) {
                $song->setAlbum(null);
            }
        }

        return $this;
    }

    public function getArtists(): ?Artists
    {
        return $this->artists;
    }

    public function setArtists(?Artists $artists): self
    {
        $this->artists = $artists;

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
}
