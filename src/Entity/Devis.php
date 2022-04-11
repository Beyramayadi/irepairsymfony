<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Devis
 *
 * @ORM\Table(name="devis", indexes={@ORM\Index(name="Id_Client", columns={"Id_Client"})})
 * @ORM\Entity
 */
class Devis
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_devis", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDevis;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_devis", type="date", nullable=false)
     */
    private $dateDevis;

    /**
     * @var \Compte
     *
     * @ORM\ManyToOne(targetEntity="Compte")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_Client", referencedColumnName="Id_Client")
     * })
     */
    private $idClient;

    public function getIdDevis(): ?int
    {
        return $this->idDevis;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDateDevis(): ?\DateTimeInterface
    {
        return $this->dateDevis;
    }

    public function setDateDevis(\DateTimeInterface $dateDevis): self
    {
        $this->dateDevis = $dateDevis;

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
