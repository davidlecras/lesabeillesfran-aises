<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @Vich\Uploadable
 */
class Product
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
     *  min = 5,
     *  max = 200,
     *  minMessage = "Votre nom doit faire au minimum {{ limit }} caractères",
     *  maxMessage = "Votre nom doit faire au maximum {{ limit }} caractères",
     *  allowEmptyString = false)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Indiquer votre commentaire")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     *@Assert\Range(
     *  min = 0.1,
     *  max = 200,
     *  minMessage = "Le prix minimum est {{ limit }} pour valider le produit",
     *  maxMessage = "Le prix maximum est {{ limit }} pour valider le produit")
     */
    private $price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stock;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): self
    {
        $this->imageFile = $imageFile;

        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Beekeeper", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $beekeeper;

    /**
     * @ORM\Column(type="integer")
     */
    private $weightInGr;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Coments", mappedBy="product")
     */
    private $coments;

    public function __construct()
    {
        $this->coments = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): self
    {
        $this->stock = $stock;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getBeekeeper(): ?Beekeeper
    {
        return $this->beekeeper;
    }

    public function setBeekeeper(?Beekeeper $beekeeper): self
    {
        $this->beekeeper = $beekeeper;

        return $this;
    }

    public function getWeightInGr(): ?int
    {
        return $this->weightInGr;
    }

    public function setWeightInGr(int $weightInGr): self
    {
        $this->weightInGr = $weightInGr;

        return $this;
    }

    /**
     * @return Collection|Coments[]
     */
    public function getComents(): Collection
    {
        return $this->coments;
    }

    public function addComent(Coments $coment): self
    {
        if (!$this->coments->contains($coment)) {
            $this->coments[] = $coment;
            $coment->setProduct($this);
        }

        return $this;
    }

    public function removeComent(Coments $coment): self
    {
        if ($this->coments->contains($coment)) {
            $this->coments->removeElement($coment);
            // set the owning side to null (unless already changed)
            if ($coment->getProduct() === $this) {
                $coment->setProduct(null);
            }
        }

        return $this;
    }
}
