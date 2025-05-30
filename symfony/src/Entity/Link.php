<?php

namespace App\Entity;

use App\Repository\LinkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LinkRepository::class)
 */
class Link
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $url;

    /**
     * @ORM\Column(type="string", length=55)
     */
    private ?string $shortUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\Column(type="integer")
     */
    private int $counter;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTime $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTime $updatedAt;

    private string $absoluteUrl;

    /**
     * @ORM\OneToMany(targetEntity=LinkAccessLog::class, mappedBy="link", orphanRemoval=true)
     */
    private Collection $accessLogs;

    /**
     * Link constructor.
     * @param string|null $url
     */
    public function __construct(?string $url = null)
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->counter = 0;
        $this->shortUrl = null;
        $this->accessLogs = new ArrayCollection();

        if ($url) {
            $this->url = $url;
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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

    public function getShortUrl(): ?string
    {
        return $this->shortUrl;
    }

    public function setShortUrl(string $shortUrl): self
    {
        $this->shortUrl = $shortUrl;

        return $this;
    }

    public function getCounter(): ?int
    {
        return $this->counter;
    }

    public function setCounter(int $counter): self
    {
        $this->counter = $counter;

        return $this;
    }

    public function increaseCounter(): void
    {
        $this->counter++;
    }

    public function decreaseCounter(): void
    {
        $this->counter--;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getAbsoluteUrl(): string
    {
        return $this->absoluteUrl;
    }

    /**
     * @param string $absoluteUrl
     */
    public function setAbsoluteUrl(string $absoluteUrl): void
    {
        $this->absoluteUrl = $absoluteUrl;
    }

    /**
     * @return Collection|LinkAccessLog[]
     */
    public function getAccessLogs(): Collection
    {
        return $this->accessLogs;
    }

    public function addAccessLog(LinkAccessLog $accessLog): self
    {
        if (!$this->accessLogs->contains($accessLog)) {
            $this->accessLogs[] = $accessLog;
            $accessLog->setLink($this);
        }

        return $this;
    }

    public function removeAccessLog(LinkAccessLog $accessLog): self
    {
        if ($this->accessLogs->removeElement($accessLog)) {
            if ($accessLog->getLink() === $this) {
                $accessLog->setLink(null);
            }
        }

        return $this;
    }
}
