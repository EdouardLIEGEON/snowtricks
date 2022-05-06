<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentsRepository::class)]
class Comments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $dateTime;

    #[ORM\Column(type: 'string', length: 50)]
    private $author;

    #[ORM\Column(type: 'string', length: 500)]
    private $content;

    #[ORM\ManyToOne(targetEntity: tricks::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $tricks_Id;

    #[ORM\Column(type: 'integer')]
    private $users_id;

    #[ORM\ManyToMany(targetEntity: users::class, inversedBy: 'comments')]
    private $parent;

    public function __construct()
    {
        $this->parent = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateTime(): ?\DateTimeInterface
    {
        return $this->dateTime;
    }

    public function setDateTime(\DateTimeInterface $dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getTricksId(): ?tricks
    {
        return $this->tricks_Id;
    }

    public function setTricksId(?tricks $tricks_Id): self
    {
        $this->tricks_Id = $tricks_Id;

        return $this;
    }

    public function getUsersId(): ?int
    {
        return $this->users_id;
    }

    public function setUsersId(int $users_id): self
    {
        $this->users_id = $users_id;

        return $this;
    }

    /**
     * @return Collection<int, users>
     */
    public function getParent(): Collection
    {
        return $this->parent;
    }

    public function addParent(users $parent): self
    {
        if (!$this->parent->contains($parent)) {
            $this->parent[] = $parent;
        }

        return $this;
    }

    public function removeParent(users $parent): self
    {
        $this->parent->removeElement($parent);

        return $this;
    }
}
