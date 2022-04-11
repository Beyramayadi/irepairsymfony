<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Stock
 *
 * @ORM\Table(name="stock", indexes={@ORM\Index(name="id_pole_fk", columns={"id_pole"})})
 * @ORM\Entity(repositoryClass=App\Repository\StockRepository::class)
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
     *     type="int",
     *     message="La valeur n'est pas valide."
     * )
     * @ORM\Column(type="string", length=30)
     */
    private $quantiteArticle;

     /**
     * @Assert\NotBlank(message=" quantite article doit etre non vide")
     * @Assert\Type(
     *     type="float",
     *     message="La valeur n'est pas valide."
     * )
     * @ORM\Column(type="string", length=30)
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
}
