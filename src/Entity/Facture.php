<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture", indexes={@ORM\Index(name="id_piece", columns={"id_piece"})})
 * @ORM\Entity
 */
class Facture
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_fact", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFact;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_prenom", type="string", length=30, nullable=false)
     */
    private $nomPrenom;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_total", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixTotal;

    /**
     * @var \Materiel
     *
     * @ORM\ManyToOne(targetEntity="Materiel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_piece", referencedColumnName="id_piece")
     * })
     */
    private $idPiece;

    public function getIdFact(): ?int
    {
        return $this->idFact;
    }

    public function getNomPrenom(): ?string
    {
        return $this->nomPrenom;
    }

    public function setNomPrenom(string $nomPrenom): self
    {
        $this->nomPrenom = $nomPrenom;

        return $this;
    }

    public function getPrixTotal(): ?float
    {
        return $this->prixTotal;
    }

    public function setPrixTotal(float $prixTotal): self
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    public function getIdPiece(): ?Materiel
    {
        return $this->idPiece;
    }

    public function setIdPiece(?Materiel $idPiece): self
    {
        $this->idPiece = $idPiece;

        return $this;
    }


}
