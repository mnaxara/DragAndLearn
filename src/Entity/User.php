<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank
     * @Assert\Length(
     * min = 2,
     * max = 15,
     * minMessage = "Le Pseudo doit faire plus de 2 caractères",
     * maxMessage = "Le Pseudo doit faire 15 caractères maximum"
     * )
     */
    private $username;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $email;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Trophy", mappedBy="user")
     */
    private $trophies;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Theme", inversedBy="users")
     */
    private $theme;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserHasExercices", mappedBy="users", orphanRemoval=true)
     */
    private $userHasExercices;

    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $avatar;

    public function __construct()
    {
        $this->exercices = new ArrayCollection();
        $this->trophies = new ArrayCollection();
        $this->theme = new ArrayCollection();
        $this->userHasExercices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }


    /**
     * @return Collection|Trophy[]
     */
    public function getTrophies(): Collection
    {
        return $this->trophies;
    }

    public function addTrophy(Trophy $trophy): self
    {
        if (!$this->trophies->contains($trophy)) {
            $this->trophies[] = $trophy;
            $trophy->addUser($this);
        }

        return $this;
    }

    public function removeTrophy(Trophy $trophy): self
    {
        if ($this->trophies->contains($trophy)) {
            $this->trophies->removeElement($trophy);
            $trophy->removeUser($this);
        }

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): self
    {
        $this->theme = $theme;

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
            $userHasExercice->setUsers($this);
        }

        return $this;
    }

    public function removeUserHasExercice(UserHasExercices $userHasExercice): self
    {
        if ($this->userHasExercices->contains($userHasExercice)) {
            $this->userHasExercices->removeElement($userHasExercice);
            // set the owning side to null (unless already changed)
            if ($userHasExercice->getUsers() === $this) {
                $userHasExercice->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */

    public function setPlainPassword($plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
}
