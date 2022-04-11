<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rendezvous
 *
 * @ORM\Table(name="rendezvous", indexes={@ORM\Index(name="id_devis_fk", columns={"id_devis"}), @ORM\Index(name="Id_Client", columns={"Id_Client"})})
 * @ORM\Entity
 */
class Rendezvous
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_rdv", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRdv;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_rdv", type="date", nullable=false)
     */
    private $dateRdv;

    /**
     * @var \Devis
     *
     * @ORM\ManyToOne(targetEntity="Devis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_devis", referencedColumnName="id_devis")
     * })
     */
    private $idDevis;

    /**
     * @var \Compte
     *
     * @ORM\ManyToOne(targetEntity="Compte")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_Client", referencedColumnName="Id_Client")
     * })
     */
    private $idClient;

    public function getIdRdv(): ?int
    {
        return $this->idRdv;
    }

    public function getDateRdv(): ?\DateTimeInterface
    {
        return $this->dateRdv;
    }

    public function setDateRdv(\DateTimeInterface $dateRdv): self
    {
        $this->dateRdv = $dateRdv;

        return $this;
    }

    public function getIdDevis(): ?Devis
    {
        return $this->idDevis;
    }

    public function setIdDevis(?Devis $idDevis): self
    {
        $this->idDevis = $idDevis;

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
