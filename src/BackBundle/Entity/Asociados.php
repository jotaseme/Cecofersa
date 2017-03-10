<?php

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asociados
 *
 * @ORM\Table(name="asociados")
 * @ORM\Entity
 */
class Asociados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_ASOCIADO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAsociado;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=150, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="DOMICILIO", type="string", length=255, nullable=true)
     */
    private $domicilio;

    /**
     * @var string
     *
     * @ORM\Column(name="POBLACION", type="string", length=100, nullable=true)
     */
    private $poblacion;

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO_POSTAL", type="string", length=30, nullable=true)
     */
    private $codigoPostal;

    /**
     * @var string
     *
     * @ORM\Column(name="PROVINCIA", type="string", length=50, nullable=true)
     */
    private $provincia;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTACTO", type="string", length=100, nullable=true)
     */
    private $contacto;

    /**
     * @var string
     *
     * @ORM\Column(name="TELEFONO", type="string", length=20, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="FAX", type="string", length=20, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="E_MAIL", type="string", length=200, nullable=true)
     */
    private $eMail;

    /**
     * @var integer
     *
     * @ORM\Column(name="NUM_EMPLEADOS", type="integer", nullable=true)
     */
    private $numEmpleados;

    /**
     * @var integer
     *
     * @ORM\Column(name="NUM_VENDEDORES", type="integer", nullable=true)
     */
    private $numVendedores;

    /**
     * @var string
     *
     * @ORM\Column(name="ZONA_INFLUENCIA", type="string", length=255, nullable=true)
     */
    private $zonaInfluencia;

    /**
     * @var string
     *
     * @ORM\Column(name="SUPERFICIE_TIENDA", type="string", length=100, nullable=true)
     */
    private $superficieTienda;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRAS_ESPEC", type="string", length=200, nullable=true)
     */
    private $otrasEspec;

    /**
     * @var integer
     *
     * @ORM\Column(name="CODIGO_ASOCIADO", type="integer", nullable=true)
     */
    private $codigoAsociado;

    /**
     * @var boolean
     *
     * @ORM\Column(name="SOLO_PEDIR_CITAS", type="boolean", nullable=true)
     */
    private $soloPedirCitas = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="LOGOTIPO", type="boolean", nullable=true)
     */
    private $logotipo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="SUP_ALMACEN", type="string", length=100, nullable=true)
     */
    private $supAlmacen;

    /**
     * @var string
     *
     * @ORM\Column(name="PAG_WEB", type="string", length=255, nullable=true)
     */
    private $pagWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="COMUNIDAD_AUTONOMA", type="string", length=100, nullable=true)
     */
    private $comunidadAutonoma;

    /**
     * @var string
     *
     * @ORM\Column(name="NIF", type="string", length=100, nullable=true)
     */
    private $nif;

    /**
     * @var string
     *
     * @ORM\Column(name="PAIS", type="string", length=10, nullable=true)
     */
    private $pais;

    /**
     * @var integer
     *
     * @ORM\Column(name="ACC_FERIA", type="integer", nullable=true)
     */
    private $accFeria = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ACTIVO_FERIA", type="integer", nullable=true)
     */
    private $activoFeria = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ACTIVO", type="integer", nullable=true)
     */
    private $activo = '1';



    /**
     * Get idAsociado
     *
     * @return integer
     */
    public function getIdAsociado()
    {
        return $this->idAsociado;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Asociados
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
     * Set domicilio
     *
     * @param string $domicilio
     *
     * @return Asociados
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
     * Set poblacion
     *
     * @param string $poblacion
     *
     * @return Asociados
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
     * Set codigoPostal
     *
     * @param string $codigoPostal
     *
     * @return Asociados
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
     * Set provincia
     *
     * @param string $provincia
     *
     * @return Asociados
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
     * Set contacto
     *
     * @param string $contacto
     *
     * @return Asociados
     */
    public function setContacto($contacto)
    {
        $this->contacto = $contacto;

        return $this;
    }

    /**
     * Get contacto
     *
     * @return string
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Asociados
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
     * @return Asociados
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
     * Set eMail
     *
     * @param string $eMail
     *
     * @return Asociados
     */
    public function setEMail($eMail)
    {
        $this->eMail = $eMail;

        return $this;
    }

    /**
     * Get eMail
     *
     * @return string
     */
    public function getEMail()
    {
        return $this->eMail;
    }

    /**
     * Set numEmpleados
     *
     * @param integer $numEmpleados
     *
     * @return Asociados
     */
    public function setNumEmpleados($numEmpleados)
    {
        $this->numEmpleados = $numEmpleados;

        return $this;
    }

    /**
     * Get numEmpleados
     *
     * @return integer
     */
    public function getNumEmpleados()
    {
        return $this->numEmpleados;
    }

    /**
     * Set numVendedores
     *
     * @param integer $numVendedores
     *
     * @return Asociados
     */
    public function setNumVendedores($numVendedores)
    {
        $this->numVendedores = $numVendedores;

        return $this;
    }

    /**
     * Get numVendedores
     *
     * @return integer
     */
    public function getNumVendedores()
    {
        return $this->numVendedores;
    }

    /**
     * Set zonaInfluencia
     *
     * @param string $zonaInfluencia
     *
     * @return Asociados
     */
    public function setZonaInfluencia($zonaInfluencia)
    {
        $this->zonaInfluencia = $zonaInfluencia;

        return $this;
    }

    /**
     * Get zonaInfluencia
     *
     * @return string
     */
    public function getZonaInfluencia()
    {
        return $this->zonaInfluencia;
    }

    /**
     * Set superficieTienda
     *
     * @param string $superficieTienda
     *
     * @return Asociados
     */
    public function setSuperficieTienda($superficieTienda)
    {
        $this->superficieTienda = $superficieTienda;

        return $this;
    }

    /**
     * Get superficieTienda
     *
     * @return string
     */
    public function getSuperficieTienda()
    {
        return $this->superficieTienda;
    }

    /**
     * Set otrasEspec
     *
     * @param string $otrasEspec
     *
     * @return Asociados
     */
    public function setOtrasEspec($otrasEspec)
    {
        $this->otrasEspec = $otrasEspec;

        return $this;
    }

    /**
     * Get otrasEspec
     *
     * @return string
     */
    public function getOtrasEspec()
    {
        return $this->otrasEspec;
    }

    /**
     * Set codigoAsociado
     *
     * @param integer $codigoAsociado
     *
     * @return Asociados
     */
    public function setCodigoAsociado($codigoAsociado)
    {
        $this->codigoAsociado = $codigoAsociado;

        return $this;
    }

    /**
     * Get codigoAsociado
     *
     * @return integer
     */
    public function getCodigoAsociado()
    {
        return $this->codigoAsociado;
    }

    /**
     * Set soloPedirCitas
     *
     * @param boolean $soloPedirCitas
     *
     * @return Asociados
     */
    public function setSoloPedirCitas($soloPedirCitas)
    {
        $this->soloPedirCitas = $soloPedirCitas;

        return $this;
    }

    /**
     * Get soloPedirCitas
     *
     * @return boolean
     */
    public function getSoloPedirCitas()
    {
        return $this->soloPedirCitas;
    }

    /**
     * Set logotipo
     *
     * @param boolean $logotipo
     *
     * @return Asociados
     */
    public function setLogotipo($logotipo)
    {
        $this->logotipo = $logotipo;

        return $this;
    }

    /**
     * Get logotipo
     *
     * @return boolean
     */
    public function getLogotipo()
    {
        return $this->logotipo;
    }

    /**
     * Set supAlmacen
     *
     * @param string $supAlmacen
     *
     * @return Asociados
     */
    public function setSupAlmacen($supAlmacen)
    {
        $this->supAlmacen = $supAlmacen;

        return $this;
    }

    /**
     * Get supAlmacen
     *
     * @return string
     */
    public function getSupAlmacen()
    {
        return $this->supAlmacen;
    }

    /**
     * Set pagWeb
     *
     * @param string $pagWeb
     *
     * @return Asociados
     */
    public function setPagWeb($pagWeb)
    {
        $this->pagWeb = $pagWeb;

        return $this;
    }

    /**
     * Get pagWeb
     *
     * @return string
     */
    public function getPagWeb()
    {
        return $this->pagWeb;
    }

    /**
     * Set comunidadAutonoma
     *
     * @param string $comunidadAutonoma
     *
     * @return Asociados
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
     * Set nif
     *
     * @param string $nif
     *
     * @return Asociados
     */
    public function setNif($nif)
    {
        $this->nif = $nif;

        return $this;
    }

    /**
     * Get nif
     *
     * @return string
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * Set pais
     *
     * @param string $pais
     *
     * @return Asociados
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
     * Set accFeria
     *
     * @param integer $accFeria
     *
     * @return Asociados
     */
    public function setAccFeria($accFeria)
    {
        $this->accFeria = $accFeria;

        return $this;
    }

    /**
     * Get accFeria
     *
     * @return integer
     */
    public function getAccFeria()
    {
        return $this->accFeria;
    }

    /**
     * Set activoFeria
     *
     * @param integer $activoFeria
     *
     * @return Asociados
     */
    public function setActivoFeria($activoFeria)
    {
        $this->activoFeria = $activoFeria;

        return $this;
    }

    /**
     * Get activoFeria
     *
     * @return integer
     */
    public function getActivoFeria()
    {
        return $this->activoFeria;
    }

    /**
     * Set activo
     *
     * @param integer $activo
     *
     * @return Asociados
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return integer
     */
    public function getActivo()
    {
        return $this->activo;
    }
}
