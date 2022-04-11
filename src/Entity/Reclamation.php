<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="id_client_fk", columns={"id_Client"})})
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_reclam", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReclam;

    /**
     * @var string
     *
     * @ORM\Column(name="Reclamation", type="text", length=65535, nullable=false)
     */
    private $reclamation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_reclamation", type="date", nullable=false)
     */
    private $dateReclamation;

    /**
     * @var \Compte
     *
     * @ORM\ManyToOne(targetEntity="Compte")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Client", referencedColumnName="Id_Client")
     * })
     */
    private $idClient;

    public function getIdReclam(): ?int
    {
        return $this->idReclam;
    }

    public function getReclamation(): ?string
    {
        return $this->reclamation;
    }

    public function setReclamation(string $reclamation): self
    {
        $this->reclamation = $reclamation;

        return $this;
    }

    public function getDateReclamation(): ?\DateTimeInterface
    {
        return $this->dateReclamation;
    }

    public function setDateReclamation(\DateTimeInterface $dateReclamation): self
    {
        $this->dateReclamation = $dateReclamation;

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
