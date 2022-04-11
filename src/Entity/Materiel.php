<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Materiel
 *
 * @ORM\Table(name="materiel", indexes={@ORM\Index(name="Id_Client", columns={"Id_Client"})})
 * @ORM\Entity
 */
class Materiel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_piece", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPiece;

    /**
     * @var string
     *
     * @ORM\Column(name="type_piece", type="string", length=30, nullable=false)
     */
    private $typePiece;

    /**
     * @var string
     *
     * @ORM\Column(name="probleme", type="text", length=65535, nullable=false)
     */
    private $probleme;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_distribution", type="date", nullable=false)
     */
    private $dateDistribution;

    /**
     * @var \Compte
     *
     * @ORM\ManyToOne(targetEntity="Compte")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_Client", referencedColumnName="Id_Client")
     * })
     */
    private $idClient;

    public function getIdPiece(): ?int
    {
        return $this->idPiece;
    }

    public function getTypePiece(): ?string
    {
        return $this->typePiece;
    }

    public function setTypePiece(string $typePiece): self
    {
        $this->typePiece = $typePiece;

        return $this;
    }

    public function getProbleme(): ?string
    {
        return $this->probleme;
    }

    public function setProbleme(string $probleme): self
    {
        $this->probleme = $probleme;

        return $this;
    }

    public function getDateDistribution(): ?\DateTimeInterface
    {
        return $this->dateDistribution;
    }

    public function setDateDistribution(\DateTimeInterface $dateDistribution): self
    {
        $this->dateDistribution = $dateDistribution;

        return $this;
    }

    public function getIdClient(): ?Compte
    {
        return $this->idClient;
    }

    public function setIdClient(?Compte $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }


}
