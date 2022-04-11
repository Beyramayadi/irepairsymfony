<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service", indexes={@ORM\Index(name="id_categorie_fk", columns={"id_categorie"})})
 * @ORM\Entity
 */
class Service
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_service", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idService;

    /**
     * @var string
     *
     * @ORM\Column(name="type_service", type="string", length=30, nullable=false)
     */
    private $typeService;

    /**
     * @var \Service
     *
     * @ORM\ManyToOne(targetEntity="Service")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_categorie", referencedColumnName="id_service")
     * })
     */
    private $idCategorie;

    public function getIdService(): ?int
    {
        return $this->idService;
    }

    public function getTypeService(): ?string
    {
        return $this->typeService;
    }

    public function setTypeService(string $typeService): self
    {
        $this->typeService = $typeService;

        return $this;
    }

    public function getIdCategorie(): ?self
    {
        return $this->idCategorie;
    }

    public function setIdCategorie(?self $idCategorie): self
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }


}
