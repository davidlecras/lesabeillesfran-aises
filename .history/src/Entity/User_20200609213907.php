<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 * fields={"email"},
 * message="Vous êtes déjà chez nous"
 * )
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
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *  min = 3,
     *  max = 100,
     *  minMessage = "Votre prénom doit faire au minimum {{ limit }} caractères",
     *  maxMessage = "Votre prénom doit faire au maximum {{ limit }} caractères",
     *  allowEmptyString = false
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *  min = 3,
     *  max = 100,
     *  minMessage = "Votre prénom doit faire au minimum {{ limit }} caractères",
     *  maxMessage = "Votre prénom doit faire au maximum {{ limit }} caractères",
     *  allowEmptyString = false
     * )
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *  message = "l'email '{{ value }}' n'est pas valide.",
     * checkMX=true
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *  min = 10,
     *  max = 20,
     *  minMessage = "Votre mot de passe doit faire au minimum {{ limit }} caractères",
     *  maxMessage = "Votre mot de passe doit faire au maximum {{ limit }} caractères",
     *  allowEmptyString = false
     * )
     * @Assert\Regex(
     *     pattern="/^(?=.{10,}$)(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])(?=.*?\W).*$/",
     *     match=true,
     *     message="Le mot de passe doit contenir au moins 1 majuscule 1 chiffre et 1 caractère spécial"
     * )
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Les mots de passe ne sont pas identiques")
     * @Assert\Length(
     *  min = 10,
     *  max = 20,
     *  minMessage = "Votre mot de passe doit faire au minimum {{ limit }} caractères",
     *  maxMessage = "Votre mot de passe doit faire au maximum {{ limit }} caractères",
     *  allowEmptyString = false
     * )
     */
    private $verifPassword;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roles;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $hasAcceptedThermsAndConditionsOfUse;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @CaptchaAssert\ValidCaptcha(
     *      message = "CAPTCHA validation failed, try again."
     * )
     */
    protected $captchaCode;

    public function getCaptchaCode()
    {
        return $this->captchaCode;
    }

    public function setCaptchaCode($captchaCode)
    {
        $this->captchaCode = $captchaCode;
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles()
    {
        return [$this->roles];
    }

    public function setRoles(string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getHasAcceptedThermsAndConditionsOfUse(): ?bool
    {
        return $this->hasAcceptedThermsAndConditionsOfUse;
    }

    public function setHasAcceptedThermsAndConditionsOfUse(?bool $hasAcceptedThermsAndConditionsOfUse): self
    {
        $this->hasAcceptedThermsAndConditionsOfUse = $hasAcceptedThermsAndConditionsOfUse;

        return $this;
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

    public function getVerifPassword(): ?string
    {
        return $this->verifPassword;
    }

    public function setVerifPassword(string $verifPassword): self
    {
        $this->verifPassword = $verifPassword;

        return $this;
    }

    public function eraseCredentials()
    {
    }

    public function getSalt()
    {
    }

    public function getUsername()
    {
    }
}
