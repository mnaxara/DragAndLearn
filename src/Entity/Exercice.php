<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExerciceRepository")
 */
class Exercice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank
     * @Assert\Length(
     * min = 2,
     * max = 15,
     * minMessage = "Le Titre de l'exercice doit faire minimum 2 caractere",
     * maxMessage = "Le Titre de l'exercice doit faire 15 caractères maximum"
     * )
     */
    private $libelle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $help;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $solution;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserHasExercices", mappedBy="exercices", orphanRemoval=true)
     */
    private $userHasExercices;

    /**
     * @Gedmo\Slug(fields={"libelle"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Level", inversedBy="exercices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $level;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->userHasExercices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getHelp(): ?string
    {
        return $this->help;
    }

    public function setHelp(?string $help): self
    {
        $this->help = $help;

        return $this;
    }

    public function getSolution(): ?string
    {
        return $this->solution;
    }

    public function setSolution(?string $solution): self
    {
        $this->solution = $solution;

        return $this;
    }

    /**
     * @return Collection|UserHasExercices[]
     */
    public function getUserHasExercices(): Collection
    {
        return $this->userHasExercices;
    }

    public function addUserHasExercice(UserHasExercices $userHasExercice): self
    {
        if (!$this->userHasExercices->contains($userHasExercice)) {
            $this->userHasExercices[] = $userHasExercice;
            $userHasExercice->setExercices($this);
        }

        return $this;
    }

    public function removeUserHasExercice(UserHasExercices $userHasExercice): self
    {
        if ($this->userHasExercices->contains($userHasExercice)) {
            $this->userHasExercices->removeElement($userHasExercice);
            // set the owning side to null (unless already changed)
            if ($userHasExercice->getExercices() === $this) {
                $userHasExercice->setExercices(null);
            }
        }

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function setLevel(?Level $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

}
