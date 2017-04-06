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
    private $isFolder = '0';

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
    private $tipoPermiso = '';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CREACION", type="date", nullable=false)
     */
    private $fechaCreacion = '0000-00-00';

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

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=45, nullable=true)
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PROVEEDOR", type="integer", nullable=true)
     */
    private $idProveedor;



    /**
     * Get idFichero
     *
     * @return integer
     */
    public function getIdFichero()
    {
        return $this->idFichero;
    }

    /**
     * Set isFolder
     *
     * @param boolean $isFolder
     *
     * @return Fichero
     */
    public function setIsFolder($isFolder)
    {
        $this->isFolder = $isFolder;

        return $this;
    }

    /**
     * Get isFolder
     *
     * @return boolean
     */
    public function getIsFolder()
    {
        return $this->isFolder;
    }

    /**
     * Set idContenedor
     *
     * @param integer $idContenedor
     *
     * @return Fichero
     */
    public function setIdContenedor($idContenedor)
    {
        $this->idContenedor = $idContenedor;

        return $this;
    }

    /**
     * Get idContenedor
     *
     * @return integer
     */
    public function getIdContenedor()
    {
        return $this->idContenedor;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Fichero
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return Fichero
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set permisos
     *
     * @param string $permisos
     *
     * @return Fichero
     */
    public function setPermisos($permisos)
    {
        $this->permisos = $permisos;

        return $this;
    }

    /**
     * Get permisos
     *
     * @return string
     */
    public function getPermisos()
    {
        return $this->permisos;
    }

    /**
     * Set tipoPermiso
     *
     * @param string $tipoPermiso
     *
     * @return Fichero
     */
    public function setTipoPermiso($tipoPermiso)
    {
        $this->tipoPermiso = $tipoPermiso;

        return $this;
    }

    /**
     * Get tipoPermiso
     *
     * @return string
     */
    public function getTipoPermiso()
    {
        return $this->tipoPermiso;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Fichero
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Fichero
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set fechaCaducidad
     *
     * @param \DateTime $fechaCaducidad
     *
     * @return Fichero
     */
    public function setFechaCaducidad($fechaCaducidad)
    {
        $this->fechaCaducidad = $fechaCaducidad;

        return $this;
    }

    /**
     * Get fechaCaducidad
     *
     * @return \DateTime
     */
    public function getFechaCaducidad()
    {
        return $this->fechaCaducidad;
    }

    /**
     * Set accDenegado
     *
     * @param string $accDenegado
     *
     * @return Fichero
     */
    public function setAccDenegado($accDenegado)
    {
        $this->accDenegado = $accDenegado;

        return $this;
    }

    /**
     * Get accDenegado
     *
     * @return string
     */
    public function getAccDenegado()
    {
        return $this->accDenegado;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Fichero
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set idProveedor
     *
     * @param integer $idProveedor
     *
     * @return Fichero
     */
    public function setIdProveedor($idProveedor)
    {
        $this->idProveedor = $idProveedor;

        return $this;
    }

    /**
     * Get idProveedor
     *
     * @return integer
     */
    public function getIdProveedor()
    {
        return $this->idProveedor;
    }
}
