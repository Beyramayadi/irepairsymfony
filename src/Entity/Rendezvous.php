<?php

namespace App\Entity;

use App\Repository\RendezvousRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=RendezvousRepository::class)
 */
class Rendezvous
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id_rdv;

    /**
     * @ORM\Column(type="date")
     * @Assert\GreaterThan("today + 5 days",message="Choisissez une date dans 5 jours minimum")
     */
    private $date_rdv;

    /**
     * 
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     * @Assert\Type(
     *     type="integer",
     *     message="La valeur n'est  valide."
     * )
     * @ORM\Column(type="integer")
     *
     * 

     */
    private $id_devis;

    /**
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     * @Assert\Type(
     *     type="integer",
     *     message="La valeur n'est pas valide."
     * )
     * @ORM\Column(type="integer")
     * 
     * 
     */
    private $id_client;

    public function getIdrdv(): ?int
    {
        return $this->id_rdv;
    }

    public function getDateRdv(): ?\DateTimeInterface
    {
        return $this->date_rdv;
    }

    public function setDateRdv(\DateTimeInterface $date_rdv): self
    {
        $this->date_rdv = $date_rdv;

        return $this;
    }

    public function getIdDevis(): ?int
    {
        return $this->id_devis;
    }

    public function setIdDevis(int $id_devis): self
    {
        $this->id_devis = $id_devis;

        return $this;
    }

    public function getIdClient(): ?int
    {
        return $this->id_client;
    }

    public function setIdClient(int $id_client): self
    {
        $this->id_client = $id_client;

        return $this;
    }
}
