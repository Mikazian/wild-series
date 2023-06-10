<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Episode;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommentRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?User $author = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?Episode $episode = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\NotBlank(message: 'Le champs ne doit pas être vide !')]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Votre message doit faire moin de 255 caractères !'
    )]
    private ?string $comment = null;

    #[ORM\Column(nullable: true)]
    #[Assert\NotBlank(message: 'Veuillez noter l\'épisode !')]
    #[Assert\Length(
        max: 3,
        maxMessage: 'La note doit faire moin de 3 caractères !'
    )]
    private ?int $rate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?user $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getEpisode(): ?Episode
    {
        return $this->episode;
    }

    public function setEpisode(?Episode $episode): self
    {
        $this->episode = $episode;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(?int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }
}
