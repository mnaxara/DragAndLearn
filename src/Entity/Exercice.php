<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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

}
