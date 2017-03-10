<?php

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", indexes={@ORM\Index(name="ID_ASOCIADO", columns={"ID_ASOCIADO"}), @ORM\Index(name="fk_proveedor_idx", columns={"ID_PROVEEDOR"})})
 * @ORM\Entity
 */
class Usuario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="LOGIN", type="string", length=20, nullable=true)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="PASSW", type="string", length=50, nullable=true)
     */
    private $passw;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_CLIENTE", type="integer", nullable=true)
     */
    private $idCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="E_MAIL", type="string", length=255, nullable=false)
     */
    private $eMail;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ACC_WEB_PRIVADA", type="boolean", nullable=true)
     */
    private $accWebPrivada;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ACC_WEB_EXPO_VIRTUAL", type="boolean", nullable=true)
     */
    private $accWebExpoVirtual;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ACC_WEB_EXPO_REAL", type="boolean", nullable=true)
     */
    private $accWebExpoReal;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_USUARIO", type="string", nullable=true)
     */
    private $tipoUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="TURNO_COMIDA", type="string", nullable=true)
     */
    private $turnoComida;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO_BLOQUEO", type="string", length=255, nullable=true)
     */
    private $estadoBloqueo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="TS_BLOQUEO", type="datetime", nullable=true)
     */
    private $tsBloqueo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="RENOVACION_PASS", type="datetime", nullable=true)
     */
    private $renovacionPass;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ACCESO", type="datetime", nullable=true)
     */
    private $acceso;

    /**
     * @var \Proveedores
     *
     * @ORM\ManyToOne(targetEntity="Proveedores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_PROVEEDOR", referencedColumnName="ID_PROVEEDOR")
     * })
     */
    private $idProveedor;

    /**
     * @var \Asociados
     *
     * @ORM\ManyToOne(targetEntity="Asociados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_ASOCIADO", referencedColumnName="ID_ASOCIADO")
     * })
     */
    private $idAsociado;


}

