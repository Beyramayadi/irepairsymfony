<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Pole
 *
 * @ORM\Table(name="pole")
 * @ORM\Entity(repositoryClass=App\Repository\PoleRepository::class)
 */
class Pole
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_pole", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPole;

     /**
     * @Assert\NotBlank(message=" nomPole doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un nomPole au mini de 5 caracteres"
     *
     *     )
     *  @Assert\Type(type={"alpha"})
     * @ORM\Column(type="string", length=30)
     */
    private $nomPole;

    /**
     * @Assert\NotBlank(message="lieuPole doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      max = 20,
     *      minMessage = "doit etre >=5 ",
     *      maxMessage = "doit etre <=20" )
     * @Assert\Type(type={"alpha"})
     * @ORM\Column(type="string", length=30)
     */
    private $lieuPole;

    public function getidPole(): ?int
    {
        return $this->idPole;
    }

    public function getnomPole(): ?string
    {
        return $this->nomPole;
    }

    public function setnomPole(string $nomPole): self
    {
        $this->nomPole = $nomPole;

        return $this;
    }

    public function getlieuPole(): ?string
    {
        return $this->lieuPole;
    }

    public function setlieuPole(string $lieuPole): self
    {
        $this->lieuPole = $lieuPole;

        return $this;
    }
    public function __toString()
    {
        return $this->nomPole;
    }
}
