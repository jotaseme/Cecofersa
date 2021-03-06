<?php

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FamiliasAsociados
 *
 * @ORM\Table(name="familias_asociados", indexes={@ORM\Index(name="fk_asociado_idx", columns={"id_asociado"}), @ORM\Index(name="fk_familia_idx", columns={"id_familia"})})
 * @ORM\Entity(repositoryClass="BackBundle\Entity\FamiliasAsociadosRepository")
 */
class FamiliasAsociados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_familias_asociados", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFamiliasAsociados;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen", type="string", length=45, nullable=true)
     */
    private $volumen;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_familia", type="string", length=255, nullable=true)
     */
    private $nombreFamilia;

    /**
     * @var \Familias
     *
     * @ORM\ManyToOne(targetEntity="Familias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_familia", referencedColumnName="id_familias")
     * })
     */
    private $idFamilia;

    /**
     * @var \Asociados
     *
     * @ORM\ManyToOne(targetEntity="Asociados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_asociado", referencedColumnName="ID_ASOCIADO")
     * })
     */
    private $idAsociado;



    /**
     * Get idFamiliasAsociados
     *
     * @return integer
     */
    public function getIdFamiliasAsociados()
    {
        return $this->idFamiliasAsociados;
    }

    /**
     * Set volumen
     *
     * @param string $volumen
     *
     * @return FamiliasAsociados
     */
    public function setVolumen($volumen)
    {
        $this->volumen = $volumen;

        return $this;
    }

    /**
     * Get volumen
     *
     * @return string
     */
    public function getVolumen()
    {
        return $this->volumen;
    }

    /**
     * Set nombreFamilia
     *
     * @param string $nombreFamilia
     *
     * @return FamiliasAsociados
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

    /**
     * Set idFamilia
     *
     * @param \BackBundle\Entity\Familias $idFamilia
     *
     * @return FamiliasAsociados
     */
    public function setIdFamilia(\BackBundle\Entity\Familias $idFamilia = null)
    {
        $this->idFamilia = $idFamilia;

        return $this;
    }

    /**
     * Get idFamilia
     *
     * @return \BackBundle\Entity\Familias
     */
    public function getIdFamilia()
    {
        return $this->idFamilia;
    }

    /**
     * Set idAsociado
     *
     * @param \BackBundle\Entity\Asociados $idAsociado
     *
     * @return FamiliasAsociados
     */
    public function setIdAsociado(\BackBundle\Entity\Asociados $idAsociado = null)
    {
        $this->idAsociado = $idAsociado;

        return $this;
    }

    /**
     * Get idAsociado
     *
     * @return \BackBundle\Entity\Asociados
     */
    public function getIdAsociado()
    {
        return $this->idAsociado;
    }
}
