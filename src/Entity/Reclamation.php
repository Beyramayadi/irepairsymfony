<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ReclamationRepository::class)
 */
class Reclamation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Id_reclam;

    /**
     * @Assert\NotBlank(message=" titre doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un titre au mini de 5 caracteres"
     *
     *     )
     * @ORM\Column(type="text")
     */
    private $Reclamation;

    /**
     * @ORM\Column(type="date")
    
     
     */
    private $Date_reclamation;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_Client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdReclam(): ?int
    {
        return $this->Id_reclam;
    }

    public function setIdReclam(int $Id_reclam): self
    {
        $this->Id_reclam = $Id_reclam;

        return $this;
    }

    public function getReclamation(): ?string
    {
        return $this->Reclamation;
    }

    public function setReclamation(string $Reclamation): self
    {
        $this->Reclamation = $Reclamation;

        return $this;
    }

    public function getDateReclamation(): ?\DateTimeInterface
    {
        return $this->Date_reclamation;
    }

    public function setDateReclamation(\DateTimeInterface $Date_reclamation): self
    {
        $this->Date_reclamation = $Date_reclamation;

        return $this;
    }

    public function getIdClient(): ?int
    {
        return $this->id_Client;
    }

    public function setIdClient(int $id_Client): self
    {
        $this->id_Client = $id_Client;

        return $this;
    }
}
