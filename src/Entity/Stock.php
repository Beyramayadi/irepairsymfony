<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Stock
 *
 * @ORM\Table(name="stock", indexes={@ORM\Index(name="id_pole_fk", columns={"id_pole"})})
 * @ORM\Entity(repositoryClass=App\Repository\StockRepository::class)
 * @Vich\Uploadable
 */
class Stock
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_article", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idArticle;

  /**
     * @Assert\NotBlank(message=" nom article doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un nomPole au mini de 5 caracteres"
     *
     *     )
     * @Assert\Type(type={"alpha"})
     * @ORM\Column(type="string", length=30)
     */
    private $nomArticle;

    /**
     * @Assert\NotBlank(message=" quantite article doit etre non vide")
     * @Assert\Type(
     *     type="integer",
     *     message="La valeur n'est pas valide."
     * )
     * @ORM\Column(type="integer", length=30)
     */
    private $quantiteArticle;

     /**
     * @Assert\NotBlank(message=" quantite article doit etre non vide")
     * @Assert\Type(
     *     type="float",
     *     message="La valeur n'est pas valide."
     * )
     * @ORM\Column(type="float", length=30)
     */
    private $prixArticle;

    /**
     * @var \Pole
     *
     * @ORM\ManyToOne(targetEntity="Pole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pole", referencedColumnName="id_pole")
     * })
     */
    private $idPole;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageName;
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="Stock", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;


  

    

    public function getidArticle(): ?int
    {
        return $this->idArticle;
    }

    public function getnomArticle(): ?string
    {
        return $this->nomArticle;
    }

    public function setnomArticle(string $nomArticle): self
    {
        $this->nomArticle = $nomArticle;

        return $this;
    }

    public function getquantiteArticle(): ?int
    {
        return $this->quantiteArticle;
    }

    public function setquantiteArticle(int $quantiteArticle): self
    {
        $this->quantiteArticle = $quantiteArticle;

        return $this;
    }
    public function getprixArticle(): ?float
    {
        return $this->prixArticle;
    }

    public function setprixArticle(float $prixArticle): self
    {
        $this->prixArticle = $prixArticle;

        return $this;
    }
    public function getidPole(): ?POle
    {
        return $this->idPole;
    }

    public function setidPole(?Pole $idPole): self
    {
        $this->idPole = $idPole;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

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
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
     * @throws \Exception
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
  
    }

   

