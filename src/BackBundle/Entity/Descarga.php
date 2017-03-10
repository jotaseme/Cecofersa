<?php

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Descarga
 *
 * @ORM\Table(name="descarga", indexes={@ORM\Index(name="USUARIO_has_FICHERO_FKIndex2", columns={"FICHERO_ID_FICHERO"}), @ORM\Index(name="DESCARGA_FKIndex2", columns={"USUARIO_ID_USUARIO"})})
 * @ORM\Entity
 */
class Descarga
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_DESCARGA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDescarga;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var \Fichero
     *
     * @ORM\ManyToOne(targetEntity="Fichero")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FICHERO_ID_FICHERO", referencedColumnName="ID_FICHERO")
     * })
     */
    private $ficheroFichero;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="USUARIO_ID_USUARIO", referencedColumnName="ID_USUARIO")
     * })
     */
    private $usuarioUsuario;



    /**
     * Get idDescarga
     *
     * @return integer
     */
    public function getIdDescarga()
    {
        return $this->idDescarga;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Descarga
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set ficheroFichero
     *
     * @param \BackBundle\Entity\Fichero $ficheroFichero
     *
     * @return Descarga
     */
    public function setFicheroFichero(\BackBundle\Entity\Fichero $ficheroFichero = null)
    {
        $this->ficheroFichero = $ficheroFichero;

        return $this;
    }

    /**
     * Get ficheroFichero
     *
     * @return \BackBundle\Entity\Fichero
     */
    public function getFicheroFichero()
    {
        return $this->ficheroFichero;
    }

    /**
     * Set usuarioUsuario
     *
     * @param \BackBundle\Entity\Usuario $usuarioUsuario
     *
     * @return Descarga
     */
    public function setUsuarioUsuario(\BackBundle\Entity\Usuario $usuarioUsuario = null)
    {
        $this->usuarioUsuario = $usuarioUsuario;

        return $this;
    }

    /**
     * Get usuarioUsuario
     *
     * @return \BackBundle\Entity\Usuario
     */
    public function getUsuarioUsuario()
    {
        return $this->usuarioUsuario;
    }
}
