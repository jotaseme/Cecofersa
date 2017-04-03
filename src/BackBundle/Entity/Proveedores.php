<?php

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proveedores
 *
 * @ORM\Table(name="proveedores")
 * @ORM\Entity
 */
class Proveedores
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PROVEEDOR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProveedor;

    /**
     * @var string
     *
     * @ORM\Column(name="PROVEEDOR", type="string", length=255, nullable=true)
     */
    private $proveedor;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_COMERCIAL", type="string", length=255, nullable=true)
     */
    private $nombreComercial;

    /**
     * @var integer
     *
     * @ORM\Column(name="GESTOR", type="integer", nullable=true)
     */
    private $gestor;

    /**
     * @var string
     *
     * @ORM\Column(name="DIRECCION", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="POBLACION", type="string", length=255, nullable=true)
     */
    private $poblacion;

    /**
     * @var string
     *
     * @ORM\Column(name="PROVINCIA", type="string", length=255, nullable=true)
     */
    private $provincia;

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO_POSTAL", type="string", length=45, nullable=true)
     */
    private $codigoPostal;

    /**
     * @var string
     *
     * @ORM\Column(name="NIF", type="string", length=45, nullable=true)
     */
    private $nif;

    /**
     * @var string
     *
     * @ORM\Column(name="TELEFONO", type="string", length=45, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="FAX", type="string", length=45, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="RESPONSABLE_CONVENIO", type="string", length=255, nullable=true)
     */
    private $responsableConvenio;

    /**
     * @var string
     *
     * @ORM\Column(name="CARGO_CONVENIO", type="string", length=255, nullable=true)
     */
    private $cargoConvenio;

    /**
     * @var string
     *
     * @ORM\Column(name="EMAIL_CONVENIO", type="string", length=255, nullable=true)
     */
    private $emailConvenio;

    /**
     * @var string
     *
     * @ORM\Column(name="CONVENIO_COLABORACION", type="string", length=45, nullable=true)
     */
    private $convenioColaboracion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CONVENIO", type="datetime", nullable=true)
     */
    private $fechaConvenio;

    /**
     * @var string
     *
     * @ORM\Column(name="VIGENCIA", type="string", length=45, nullable=true)
     */
    private $vigencia;

    /**
     * @var string
     *
     * @ORM\Column(name="PRECIOS", type="string", length=45, nullable=true)
     */
    private $precios;

    /**
     * @var string
     *
     * @ORM\Column(name="IVA", type="string", length=45, nullable=true)
     */
    private $iva;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCUENTOS_FACTURA", type="text", length=65535, nullable=true)
     */
    private $descuentosFactura;

    /**
     * @var string
     *
     * @ORM\Column(name="GESTION_CENTRALIZADA", type="string", length=45, nullable=true)
     */
    private $gestionCentralizada;

    /**
     * @var string
     *
     * @ORM\Column(name="PORTES_PENINSULA", type="string", length=255, nullable=true)
     */
    private $portesPeninsula;

    /**
     * @var string
     *
     * @ORM\Column(name="FORMA_PAGO", type="string", length=45, nullable=true)
     */
    private $formaPago;

    /**
     * @var string
     *
     * @ORM\Column(name="PRONTO_PAGO", type="string", length=45, nullable=true)
     */
    private $prontoPago;

    /**
     * @var string
     *
     * @ORM\Column(name="ANDORRA", type="string", length=45, nullable=true)
     */
    private $andorra;

    /**
     * @var string
     *
     * @ORM\Column(name="GIBRALTAR", type="string", length=45, nullable=true)
     */
    private $gibraltar;

    /**
     * @var string
     *
     * @ORM\Column(name="PORTUGAL", type="string", length=255, nullable=true)
     */
    private $portugal;

    /**
     * @var string
     *
     * @ORM\Column(name="CANARIAS", type="string", length=255, nullable=true)
     */
    private $canarias;

    /**
     * @var string
     *
     * @ORM\Column(name="BALEARES", type="string", length=255, nullable=true)
     */
    private $baleares;

    /**
     * @var string
     *
     * @ORM\Column(name="CEUTA_MELILLA", type="string", length=255, nullable=true)
     */
    private $ceutaMelilla;

    /**
     * @var string
     *
     * @ORM\Column(name="ARTICULOS_COMERCIALIZA", type="text", length=65535, nullable=true)
     */
    private $articulosComercializa;

    /**
     * @var string
     *
     * @ORM\Column(name="ARTICULOS_PROVEEDOR", type="text", length=65535, nullable=true)
     */
    private $articulosProveedor;

    /**
     * @var string
     *
     * @ORM\Column(name="RAPPEL_CECOFERSA", type="string", length=255, nullable=true)
     */
    private $rappelCecofersa;

    /**
     * @var string
     *
     * @ORM\Column(name="RAPPEL_ASOCIADO", type="string", length=255, nullable=true)
     */
    private $rappelAsociado;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="PARTICIPACION_CATALOGO", type="string", length=45, nullable=true)
     */
    private $participacionCatalogo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ALTA", type="datetime", nullable=true)
     */
    private $fechaAlta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_BAJA", type="datetime", nullable=true)
     */
    private $fechaBaja;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_EDICION", type="datetime", nullable=true)
     */
    private $fechaEdicion;

    /**
     * @var string
     *
     * @ORM\Column(name="PAGINA_WEB", type="string", length=45, nullable=true)
     */
    private $paginaWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="VALIDEZ_ESPA", type="string", length=45, nullable=true)
     */
    private $validezEspa;

    /**
     * @var string
     *
     * @ORM\Column(name="VALIDEZ_PORTUGAL", type="string", length=45, nullable=true)
     */
    private $validezPortugal;

    /**
     * @var string
     *
     * @ORM\Column(name="PEDIDO_MINIMO", type="string", length=45, nullable=true)
     */
    private $pedidoMinimo;

    /**
     * @var string
     *
     * @ORM\Column(name="MARCAS", type="text", length=65535, nullable=true)
     */
    private $marcas;

    /**
     * @var string
     *
     * @ORM\Column(name="FAMILIA", type="string", length=45, nullable=true)
     */
    private $familia;

    /**
     * @var string
     *
     * @ORM\Column(name="EXPOCECOFERSA", type="string", length=45, nullable=true)
     */
    private $expocecofersa;

    /**
     * @var string
     *
     * @ORM\Column(name="PUBLICIDAD", type="string", length=500, nullable=true)
     */
    private $publicidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="REFERENCIA_DELCREDIT", type="integer", nullable=true)
     */
    private $referenciaDelcredit;

    /**
     * @var string
     *
     * @ORM\Column(name="LOGOTIPO", type="string", length=45, nullable=true)
     */
    private $logotipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ACTIVO", type="integer", nullable=true)
     */
    private $activo;

    /**
     * @ORM\OneToMany(targetEntity="UsuarioProveedor", mappedBy="idProveedor")
     */
    protected $usuarios;

    /**
     * Get idProveedor
     *
     * @return integer
     */
    public function getIdProveedor()
    {
        return $this->idProveedor;
    }

    /**
     * Set proveedor
     *
     * @param string $proveedor
     *
     * @return Proveedores
     */
    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get proveedor
     *
     * @return string
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set nombreComercial
     *
     * @param string $nombreComercial
     *
     * @return Proveedores
     */
    public function setNombreComercial($nombreComercial)
    {
        $this->nombreComercial = $nombreComercial;

        return $this;
    }

    /**
     * Get nombreComercial
     *
     * @return string
     */
    public function getNombreComercial()
    {
        return $this->nombreComercial;
    }

    /**
     * Set gestor
     *
     * @param integer $gestor
     *
     * @return Proveedores
     */
    public function setGestor($gestor)
    {
        $this->gestor = $gestor;

        return $this;
    }

    /**
     * Get gestor
     *
     * @return integer
     */
    public function getGestor()
    {
        return $this->gestor;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Proveedores
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set poblacion
     *
     * @param string $poblacion
     *
     * @return Proveedores
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
     * @return Proveedores
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
     * Set codigoPostal
     *
     * @param string $codigoPostal
     *
     * @return Proveedores
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
     * Set nif
     *
     * @param string $nif
     *
     * @return Proveedores
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
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Proveedores
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
     * @return Proveedores
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
     * Set responsableConvenio
     *
     * @param string $responsableConvenio
     *
     * @return Proveedores
     */
    public function setResponsableConvenio($responsableConvenio)
    {
        $this->responsableConvenio = $responsableConvenio;

        return $this;
    }

    /**
     * Get responsableConvenio
     *
     * @return string
     */
    public function getResponsableConvenio()
    {
        return $this->responsableConvenio;
    }

    /**
     * Set cargoConvenio
     *
     * @param string $cargoConvenio
     *
     * @return Proveedores
     */
    public function setCargoConvenio($cargoConvenio)
    {
        $this->cargoConvenio = $cargoConvenio;

        return $this;
    }

    /**
     * Get cargoConvenio
     *
     * @return string
     */
    public function getCargoConvenio()
    {
        return $this->cargoConvenio;
    }

    /**
     * Set emailConvenio
     *
     * @param string $emailConvenio
     *
     * @return Proveedores
     */
    public function setEmailConvenio($emailConvenio)
    {
        $this->emailConvenio = $emailConvenio;

        return $this;
    }

    /**
     * Get emailConvenio
     *
     * @return string
     */
    public function getEmailConvenio()
    {
        return $this->emailConvenio;
    }

    /**
     * Set convenioColaboracion
     *
     * @param string $convenioColaboracion
     *
     * @return Proveedores
     */
    public function setConvenioColaboracion($convenioColaboracion)
    {
        $this->convenioColaboracion = $convenioColaboracion;

        return $this;
    }

    /**
     * Get convenioColaboracion
     *
     * @return string
     */
    public function getConvenioColaboracion()
    {
        return $this->convenioColaboracion;
    }

    /**
     * Set fechaConvenio
     *
     * @param \DateTime $fechaConvenio
     *
     * @return Proveedores
     */
    public function setFechaConvenio($fechaConvenio)
    {
        $this->fechaConvenio = $fechaConvenio;

        return $this;
    }

    /**
     * Get fechaConvenio
     *
     * @return \DateTime
     */
    public function getFechaConvenio()
    {
        return $this->fechaConvenio;
    }

    /**
     * Set vigencia
     *
     * @param string $vigencia
     *
     * @return Proveedores
     */
    public function setVigencia($vigencia)
    {
        $this->vigencia = $vigencia;

        return $this;
    }

    /**
     * Get vigencia
     *
     * @return string
     */
    public function getVigencia()
    {
        return $this->vigencia;
    }

    /**
     * Set precios
     *
     * @param string $precios
     *
     * @return Proveedores
     */
    public function setPrecios($precios)
    {
        $this->precios = $precios;

        return $this;
    }

    /**
     * Get precios
     *
     * @return string
     */
    public function getPrecios()
    {
        return $this->precios;
    }

    /**
     * Set iva
     *
     * @param string $iva
     *
     * @return Proveedores
     */
    public function setIva($iva)
    {
        $this->iva = $iva;

        return $this;
    }

    /**
     * Get iva
     *
     * @return string
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set descuentosFactura
     *
     * @param string $descuentosFactura
     *
     * @return Proveedores
     */
    public function setDescuentosFactura($descuentosFactura)
    {
        $this->descuentosFactura = $descuentosFactura;

        return $this;
    }

    /**
     * Get descuentosFactura
     *
     * @return string
     */
    public function getDescuentosFactura()
    {
        return $this->descuentosFactura;
    }

    /**
     * Set gestionCentralizada
     *
     * @param string $gestionCentralizada
     *
     * @return Proveedores
     */
    public function setGestionCentralizada($gestionCentralizada)
    {
        $this->gestionCentralizada = $gestionCentralizada;

        return $this;
    }

    /**
     * Get gestionCentralizada
     *
     * @return string
     */
    public function getGestionCentralizada()
    {
        return $this->gestionCentralizada;
    }

    /**
     * Set portesPeninsula
     *
     * @param string $portesPeninsula
     *
     * @return Proveedores
     */
    public function setPortesPeninsula($portesPeninsula)
    {
        $this->portesPeninsula = $portesPeninsula;

        return $this;
    }

    /**
     * Get portesPeninsula
     *
     * @return string
     */
    public function getPortesPeninsula()
    {
        return $this->portesPeninsula;
    }

    /**
     * Set formaPago
     *
     * @param string $formaPago
     *
     * @return Proveedores
     */
    public function setFormaPago($formaPago)
    {
        $this->formaPago = $formaPago;

        return $this;
    }

    /**
     * Get formaPago
     *
     * @return string
     */
    public function getFormaPago()
    {
        return $this->formaPago;
    }

    /**
     * Set prontoPago
     *
     * @param string $prontoPago
     *
     * @return Proveedores
     */
    public function setProntoPago($prontoPago)
    {
        $this->prontoPago = $prontoPago;

        return $this;
    }

    /**
     * Get prontoPago
     *
     * @return string
     */
    public function getProntoPago()
    {
        return $this->prontoPago;
    }

    /**
     * Set andorra
     *
     * @param string $andorra
     *
     * @return Proveedores
     */
    public function setAndorra($andorra)
    {
        $this->andorra = $andorra;

        return $this;
    }

    /**
     * Get andorra
     *
     * @return string
     */
    public function getAndorra()
    {
        return $this->andorra;
    }

    /**
     * Set gibraltar
     *
     * @param string $gibraltar
     *
     * @return Proveedores
     */
    public function setGibraltar($gibraltar)
    {
        $this->gibraltar = $gibraltar;

        return $this;
    }

    /**
     * Get gibraltar
     *
     * @return string
     */
    public function getGibraltar()
    {
        return $this->gibraltar;
    }

    /**
     * Set portugal
     *
     * @param string $portugal
     *
     * @return Proveedores
     */
    public function setPortugal($portugal)
    {
        $this->portugal = $portugal;

        return $this;
    }

    /**
     * Get portugal
     *
     * @return string
     */
    public function getPortugal()
    {
        return $this->portugal;
    }

    /**
     * Set canarias
     *
     * @param string $canarias
     *
     * @return Proveedores
     */
    public function setCanarias($canarias)
    {
        $this->canarias = $canarias;

        return $this;
    }

    /**
     * Get canarias
     *
     * @return string
     */
    public function getCanarias()
    {
        return $this->canarias;
    }

    /**
     * Set baleares
     *
     * @param string $baleares
     *
     * @return Proveedores
     */
    public function setBaleares($baleares)
    {
        $this->baleares = $baleares;

        return $this;
    }

    /**
     * Get baleares
     *
     * @return string
     */
    public function getBaleares()
    {
        return $this->baleares;
    }

    /**
     * Set ceutaMelilla
     *
     * @param string $ceutaMelilla
     *
     * @return Proveedores
     */
    public function setCeutaMelilla($ceutaMelilla)
    {
        $this->ceutaMelilla = $ceutaMelilla;

        return $this;
    }

    /**
     * Get ceutaMelilla
     *
     * @return string
     */
    public function getCeutaMelilla()
    {
        return $this->ceutaMelilla;
    }

    /**
     * Set articulosComercializa
     *
     * @param string $articulosComercializa
     *
     * @return Proveedores
     */
    public function setArticulosComercializa($articulosComercializa)
    {
        $this->articulosComercializa = $articulosComercializa;

        return $this;
    }

    /**
     * Get articulosComercializa
     *
     * @return string
     */
    public function getArticulosComercializa()
    {
        return $this->articulosComercializa;
    }

    /**
     * Set articulosProveedor
     *
     * @param string $articulosProveedor
     *
     * @return Proveedores
     */
    public function setArticulosProveedor($articulosProveedor)
    {
        $this->articulosProveedor = $articulosProveedor;

        return $this;
    }

    /**
     * Get articulosProveedor
     *
     * @return string
     */
    public function getArticulosProveedor()
    {
        return $this->articulosProveedor;
    }

    /**
     * Set rappelCecofersa
     *
     * @param string $rappelCecofersa
     *
     * @return Proveedores
     */
    public function setRappelCecofersa($rappelCecofersa)
    {
        $this->rappelCecofersa = $rappelCecofersa;

        return $this;
    }

    /**
     * Get rappelCecofersa
     *
     * @return string
     */
    public function getRappelCecofersa()
    {
        return $this->rappelCecofersa;
    }

    /**
     * Set rappelAsociado
     *
     * @param string $rappelAsociado
     *
     * @return Proveedores
     */
    public function setRappelAsociado($rappelAsociado)
    {
        $this->rappelAsociado = $rappelAsociado;

        return $this;
    }

    /**
     * Get rappelAsociado
     *
     * @return string
     */
    public function getRappelAsociado()
    {
        return $this->rappelAsociado;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return Proveedores
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
     * Set participacionCatalogo
     *
     * @param string $participacionCatalogo
     *
     * @return Proveedores
     */
    public function setParticipacionCatalogo($participacionCatalogo)
    {
        $this->participacionCatalogo = $participacionCatalogo;

        return $this;
    }

    /**
     * Get participacionCatalogo
     *
     * @return string
     */
    public function getParticipacionCatalogo()
    {
        return $this->participacionCatalogo;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     *
     * @return Proveedores
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    /**
     * Get fechaAlta
     *
     * @return \DateTime
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * Set fechaBaja
     *
     * @param \DateTime $fechaBaja
     *
     * @return Proveedores
     */
    public function setFechaBaja($fechaBaja)
    {
        $this->fechaBaja = $fechaBaja;

        return $this;
    }

    /**
     * Get fechaBaja
     *
     * @return \DateTime
     */
    public function getFechaBaja()
    {
        return $this->fechaBaja;
    }

    /**
     * Set fechaEdicion
     *
     * @param \DateTime $fechaEdicion
     *
     * @return Proveedores
     */
    public function setFechaEdicion($fechaEdicion)
    {
        $this->fechaEdicion = $fechaEdicion;

        return $this;
    }

    /**
     * Get fechaEdicion
     *
     * @return \DateTime
     */
    public function getFechaEdicion()
    {
        return $this->fechaEdicion;
    }

    /**
     * Set paginaWeb
     *
     * @param string $paginaWeb
     *
     * @return Proveedores
     */
    public function setPaginaWeb($paginaWeb)
    {
        $this->paginaWeb = $paginaWeb;

        return $this;
    }

    /**
     * Get paginaWeb
     *
     * @return string
     */
    public function getPaginaWeb()
    {
        return $this->paginaWeb;
    }

    /**
     * Set validezEspa
     *
     * @param string $validezEspa
     *
     * @return Proveedores
     */
    public function setValidezEspa($validezEspa)
    {
        $this->validezEspa = $validezEspa;

        return $this;
    }

    /**
     * Get validezEspa
     *
     * @return string
     */
    public function getValidezEspa()
    {
        return $this->validezEspa;
    }

    /**
     * Set validezPortugal
     *
     * @param string $validezPortugal
     *
     * @return Proveedores
     */
    public function setValidezPortugal($validezPortugal)
    {
        $this->validezPortugal = $validezPortugal;

        return $this;
    }

    /**
     * Get validezPortugal
     *
     * @return string
     */
    public function getValidezPortugal()
    {
        return $this->validezPortugal;
    }

    /**
     * Set pedidoMinimo
     *
     * @param string $pedidoMinimo
     *
     * @return Proveedores
     */
    public function setPedidoMinimo($pedidoMinimo)
    {
        $this->pedidoMinimo = $pedidoMinimo;

        return $this;
    }

    /**
     * Get pedidoMinimo
     *
     * @return string
     */
    public function getPedidoMinimo()
    {
        return $this->pedidoMinimo;
    }

    /**
     * Set marcas
     *
     * @param string $marcas
     *
     * @return Proveedores
     */
    public function setMarcas($marcas)
    {
        $this->marcas = $marcas;

        return $this;
    }

    /**
     * Get marcas
     *
     * @return string
     */
    public function getMarcas()
    {
        return $this->marcas;
    }

    /**
     * Set familia
     *
     * @param string $familia
     *
     * @return Proveedores
     */
    public function setFamilia($familia)
    {
        $this->familia = $familia;

        return $this;
    }

    /**
     * Get familia
     *
     * @return string
     */
    public function getFamilia()
    {
        return $this->familia;
    }

    /**
     * Set expocecofersa
     *
     * @param string $expocecofersa
     *
     * @return Proveedores
     */
    public function setExpocecofersa($expocecofersa)
    {
        $this->expocecofersa = $expocecofersa;

        return $this;
    }

    /**
     * Get expocecofersa
     *
     * @return string
     */
    public function getExpocecofersa()
    {
        return $this->expocecofersa;
    }

    /**
     * Set publicidad
     *
     * @param string $publicidad
     *
     * @return Proveedores
     */
    public function setPublicidad($publicidad)
    {
        $this->publicidad = $publicidad;

        return $this;
    }

    /**
     * Get publicidad
     *
     * @return string
     */
    public function getPublicidad()
    {
        return $this->publicidad;
    }

    /**
     * Set referenciaDelcredit
     *
     * @param integer $referenciaDelcredit
     *
     * @return Proveedores
     */
    public function setReferenciaDelcredit($referenciaDelcredit)
    {
        $this->referenciaDelcredit = $referenciaDelcredit;

        return $this;
    }

    /**
     * Get referenciaDelcredit
     *
     * @return integer
     */
    public function getReferenciaDelcredit()
    {
        return $this->referenciaDelcredit;
    }

    /**
     * Set logotipo
     *
     * @param string $logotipo
     *
     * @return Proveedores
     */
    public function setLogotipo($logotipo)
    {
        $this->logotipo = $logotipo;

        return $this;
    }

    /**
     * Get logotipo
     *
     * @return string
     */
    public function getLogotipo()
    {
        return $this->logotipo;
    }

    /**
     * Set activo
     *
     * @param integer $activo
     *
     * @return Proveedores
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

    /**
     * Get usuarios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }
}
