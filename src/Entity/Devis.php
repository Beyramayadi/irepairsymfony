<?php

namespace App\Entity;

use App\Repository\DevisRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DevisRepository::class)
 */
class Devis
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id_devis;

    /**
     * @Assert\Type(
     *     type="float",
     *     message="La valeur n'est pas valide."
     * )
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @Assert\Type(
     *     type="integer",
     *     message="La valeur n'est pas valide"
     * )
     * @ORM\Column(type="integer")
     */
    private $Id_Client;

    /**
     * @ORM\Column(type="date")
     */
    private $date_devis;

     /**
     * @ORM\Column(type="string")
     */
    private $titre;

    public function getIddevis(): ?int
    {
        return $this->id_devis;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getIdClient(): ?int
    {
        return $this->Id_Client;
    }

    public function setIdClient(int $Id_Client): self
    {
        $this->Id_Client = $Id_Client;

        return $this;
    }

    public function getDateDevis(): ?\DateTimeInterface
    {
        return $this->date_devis;
    }

    public function setDateDevis(\DateTimeInterface $date_devis): self
    {
        $this->date_devis = $date_devis;

        return $this;
    }
    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }
    public function __toString() {
        return(string) $this->getTitre();
    }

}
