<?php

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DireccionesAsociados
 *
 * @ORM\Table(name="direcciones_asociados", indexes={@ORM\Index(name="fk_asociado_idx", columns={"idAsociado"}), @ORM\Index(name="fk_direccion_asociado_idx", columns={"idAsociado"})})
 * @ORM\Entity
 */
class DireccionesAsociados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_direcciones", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDirecciones;

    /**
     * @var string
     *
     * @ORM\Column(name="domicilio", type="string", length=255, nullable=true)
     */
    private $domicilio;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_postal", type="string", length=45, nullable=true)
     */
    private $codigoPostal;

    /**
     * @var string
     *
     * @ORM\Column(name="poblacion", type="string", length=255, nullable=true)
     */
    private $poblacion;

    /**
     * @var string
     *
     * @ORM\Column(name="provincia", type="string", length=255, nullable=true)
     */
    private $provincia;

    /**
     * @var string
     *
     * @ORM\Column(name="comunidad_autonoma", type="string", length=255, nullable=true)
     */
    private $comunidadAutonoma;

    /**
     * @var string
     *
     * @ORM\Column(name="pais", type="string", length=255, nullable=true)
     */
    private $pais;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=45, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=45, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="oficina", type="string", length=45, nullable=true)
     */
    private $oficina;

    /**
     * @var string
     *
     * @ORM\Column(name="almacen", type="string", length=45, nullable=true)
     */
    private $almacen;

    /**
     * @var string
     *
     * @ORM\Column(name="tienda", type="string", length=45, nullable=true)
     */
    private $tienda;

    /**
     * @var string
     *
     * @ORM\Column(name="privado", type="string", length=45, nullable=true)
     */
    private $privado;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="etiquetas", type="string", length=45, nullable=true)
     */
    private $etiquetas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=true)
     */
    private $createdat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     */
    private $updatedat;

    /**
     * @var \Asociados
     *
     * @ORM\ManyToOne(targetEntity="Asociados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idAsociado", referencedColumnName="ID_ASOCIADO")
     * })
     */
    private $idasociado;



    /**
     * Get idDirecciones
     *
     * @return integer
     */
    public function getIdDirecciones()
    {
        return $this->idDirecciones;
    }

    /**
     * Set domicilio
     *
     * @param string $domicilio
     *
     * @return DireccionesAsociados
     */
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;

        return $this;
    }

    /**
     * Get domicilio
     *
     * @return string
     */
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * Set codigoPostal
     *
     * @param string $codigoPostal
     *
     * @return DireccionesAsociados
     */
    public function setCodigoPostal($codigoPostal)
    {
        $this->codigoPostal = $codigoPostal;

        return $this;
    }

    /**
     * Get codigoPostal
     *
     * @return string
     */
    public function getCodigoPostal()
    {
        return $this->codigoPostal;
    }

    /**
     * Set poblacion
     *
     * @param string $poblacion
     *
     * @return DireccionesAsociados
     */
    public function setPoblacion($poblacion)
    {
        $this->poblacion = $poblacion;

        return $this;
    }

    /**
     * Get poblacion
     *
     * @return string
     */
    public function getPoblacion()
    {
        return $this->poblacion;
    }

    /**
     * Set provincia
     *
     * @param string $provincia
     *
     * @return DireccionesAsociados
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return string
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set comunidadAutonoma
     *
     * @param string $comunidadAutonoma
     *
     * @return DireccionesAsociados
     */
    public function setComunidadAutonoma($comunidadAutonoma)
    {
        $this->comunidadAutonoma = $comunidadAutonoma;

        return $this;
    }

    /**
     * Get comunidadAutonoma
     *
     * @return string
     */
    public function getComunidadAutonoma()
    {
        return $this->comunidadAutonoma;
    }

    /**
     * Set pais
     *
     * @param string $pais
     *
     * @return DireccionesAsociados
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return DireccionesAsociados
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return DireccionesAsociados
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set oficina
     *
     * @param string $oficina
     *
     * @return DireccionesAsociados
     */
    public function setOficina($oficina)
    {
        $this->oficina = $oficina;

        return $this;
    }

    /**
     * Get oficina
     *
     * @return string
     */
    public function getOficina()
    {
        return $this->oficina;
    }

    /**
     * Set almacen
     *
     * @param string $almacen
     *
     * @return DireccionesAsociados
     */
    public function setAlmacen($almacen)
    {
        $this->almacen = $almacen;

        return $this;
    }

    /**
     * Get almacen
     *
     * @return string
     */
    public function getAlmacen()
    {
        return $this->almacen;
    }

    /**
     * Set tienda
     *
     * @param string $tienda
     *
     * @return DireccionesAsociados
     */
    public function setTienda($tienda)
    {
        $this->tienda = $tienda;

        return $this;
    }

    /**
     * Get tienda
     *
     * @return string
     */
    public function getTienda()
    {
        return $this->tienda;
    }

    /**
     * Set privado
     *
     * @param string $privado
     *
     * @return DireccionesAsociados
     */
    public function setPrivado($privado)
    {
        $this->privado = $privado;

        return $this;
    }

    /**
     * Get privado
     *
     * @return string
     */
    public function getPrivado()
    {
        return $this->privado;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return DireccionesAsociados
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
     * Set etiquetas
     *
     * @param string $etiquetas
     *
     * @return DireccionesAsociados
     */
    public function setEtiquetas($etiquetas)
    {
        $this->etiquetas = $etiquetas;

        return $this;
    }

    /**
     * Get etiquetas
     *
     * @return string
     */
    public function getEtiquetas()
    {
        return $this->etiquetas;
    }

    /**
     * Set createdat
     *
     * @param \DateTime $createdat
     *
     * @return DireccionesAsociados
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;

        return $this;
    }

    /**
     * Get createdat
     *
     * @return \DateTime
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * Set updatedat
     *
     * @param \DateTime $updatedat
     *
     * @return DireccionesAsociados
     */
    public function setUpdatedat($updatedat)
    {
        $this->updatedat = $updatedat;

        return $this;
    }

    /**
     * Get updatedat
     *
     * @return \DateTime
     */
    public function getUpdatedat()
    {
        return $this->updatedat;
    }

    /**
     * Set idasociado
     *
     * @param \BackBundle\Entity\Asociados $idasociado
     *
     * @return DireccionesAsociados
     */
    public function setIdasociado(\BackBundle\Entity\Asociados $idasociado = null)
    {
        $this->idasociado = $idasociado;

        return $this;
    }

    /**
     * Get idasociado
     *
     * @return \BackBundle\Entity\Asociados
     */
    public function getIdasociado()
    {
        return $this->idasociado;
    }
}
