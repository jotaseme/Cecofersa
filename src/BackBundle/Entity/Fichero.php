<?php

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fichero
 *
 * @ORM\Table(name="fichero")
 * @ORM\Entity
 */
class Fichero
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_FICHERO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFichero;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IS_FOLDER", type="boolean", nullable=false)
     */
    private $isFolder;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_CONTENEDOR", type="integer", nullable=true)
     */
    private $idContenedor;

    /**
     * @var string
     *
     * @ORM\Column(name="PATH", type="text", length=65535, nullable=false)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="PERMISOS", type="text", length=65535, nullable=false)
     */
    private $permisos;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_PERMISO", type="string", length=1, nullable=false)
     */
    private $tipoPermiso;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CREACION", type="date", nullable=false)
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CADUCIDAD", type="date", nullable=true)
     */
    private $fechaCaducidad;

    /**
     * @var string
     *
     * @ORM\Column(name="ACC_DENEGADO", type="text", length=65535, nullable=true)
     */
    private $accDenegado;


}

