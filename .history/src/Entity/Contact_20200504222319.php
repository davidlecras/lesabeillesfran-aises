<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{

  /**
   * @var string|null
   * @Assert\NotBlank()
   * @Assert\Email()
   */
  private $email;

  /**
   * @var string|null
   * @Assert\NotBlank()
   * @Assert\Length(min=10)
   */
  private $objet;

  /**
   * @var string|null
   * @Assert\NotBlank()
   * @Assert\Length(min=10)
   */
  private $message;


  /**
   * @return null|string
   */
  public function getEmail(): ?string
  {
    return $this->email;
  }

  /**
   * @param null|string $email
   * @return Contact
   */
  public function setEmail(?string $email): Contact
  {
    $this->email = $email;
    return $this;
  }

  /**
   * @return null|string
   */
  public function getObjet(): ?string
  {
    return $this->objet;
  }

  /**
   * @param null|string $objet
   * @return Contact
   */
  public function setObjet(?string $objet): Contact
  {
    $this->objet = $objet;
    return $this;
  }

  /**
   * @return null|string
   */
  public function getMessage(): ?string
  {
    return $this->message;
  }

  /**
   * @param null|string $message
   * @return Contact
   */
  public function setMessage(?string $message): Contact
  {
    $this->message = $message;
    return $this;
  }
}
