<?php

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Familias
 *
 * @ORM\Table(name="familias")
 * @ORM\Entity
 */
class Familias
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_familias", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFamilias;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_familia", type="string", length=255, nullable=true)
     */
    private $nombreFamilia;



    /**
     * Get idFamilias
     *
     * @return integer
     */
    public function getIdFamilias()
    {
        return $this->idFamilias;
    }

    /**
     * Set nombreFamilia
     *
     * @param string $nombreFamilia
     *
     * @return Familias
     */
    public function setNombreFamilia($nombreFamilia)
    {
        $this->nombreFamilia = $nombreFamilia;

        return $this;
    }

    /**
     * Get nombreFamilia
     *
     * @return string
     */
    public function getNombreFamilia()
    {
        return $this->nombreFamilia;
    }
}
