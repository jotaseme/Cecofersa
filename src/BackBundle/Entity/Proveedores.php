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
     * @ORM\Column(name="NUMERO_CONVENIO", type="string", length=8, nullable=true)
     */
    private $numeroConvenio;

    /**
     * @var string
     *
     * @ORM\Column(name="RAZON_SOCIAL", type="string", length=100, nullable=true)
     */
    private $razonSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_COMERCIAL", type="string", length=255, nullable=true)
     */
    private $nombreComercial;

    /**
     * @var string
     *
     * @ORM\Column(name="DIRECCION", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="POBLACION", type="string", length=90, nullable=true)
     */
    private $poblacion;

    /**
     * @var string
     *
     * @ORM\Column(name="PROVINCIA", type="string", length=90, nullable=true)
     */
    private $provincia;

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO_POSTAL", type="string", length=30, nullable=true)
     */
    private $codigoPostal;

    /**
     * @var string
     *
     * @ORM\Column(name="CIF", type="string", length=255, nullable=true)
     */
    private $cif;

    /**
     * @var string
     *
     * @ORM\Column(name="TELEFONO", type="string", length=90, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="FAX", type="string", length=90, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="E_MAIL", type="string", length=255, nullable=true)
     */
    private $eMail;

    /**
     * @var string
     *
     * @ORM\Column(name="RESPONSABLE", type="string", length=255, nullable=true)
     */
    private $responsable;

    /**
     * @var string
     *
     * @ORM\Column(name="CARGO_RESPONSABLE", type="string", length=255, nullable=true)
     */
    private $cargoResponsable;

    /**
     * @var string
     *
     * @ORM\Column(name="MARCAS", type="text", length=65535, nullable=true)
     */
    private $marcas;

    /**
     * @var string
     *
     * @ORM\Column(name="PARTICIPO_CATALOGO", type="string", length=50, nullable=true)
     */
    private $participoCatalogo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="LOGOTIPO", type="boolean", nullable=true)
     */
    private $logotipo;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="FORMA_DE_PAGO", type="string", length=255, nullable=true)
     */
    private $formaDePago;

    /**
     * @var string
     *
     * @ORM\Column(name="DTOS_FACTURA", type="text", length=65535, nullable=true)
     */
    private $dtosFactura;

    /**
     * @var string
     *
     * @ORM\Column(name="IVA", type="string", length=100, nullable=true)
     */
    private $iva;

    /**
     * @var string
     *
     * @ORM\Column(name="PRECIOS", type="string", length=255, nullable=true)
     */
    private $precios;

    /**
     * @var string
     *
     * @ORM\Column(name="VIGENCIA", type="string", length=50, nullable=true)
     */
    private $vigencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CONVENIO", type="datetime", nullable=true)
     */
    private $fechaConvenio;

    /**
     * @var string
     *
     * @ORM\Column(name="ARTICULOS_PROVEEDOR", type="string", length=765, nullable=true)
     */
    private $articulosProveedor;


}

