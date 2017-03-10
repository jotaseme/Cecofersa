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


}

