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
     * @var \Asociados
     *
     * @ORM\ManyToOne(targetEntity="Asociados",inversedBy="usuarios")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="ID_ASOCIADO", referencedColumnName="ID_ASOCIADO")
     * })
     */
    private $idAsociado;

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
     * Get idUsuario
     *
     * @return integer
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return Usuario
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set passw
     *
     * @param string $passw
     *
     * @return Usuario
     */
    public function setPassw($passw)
    {
        $this->passw = $passw;

        return $this;
    }

    /**
     * Get passw
     *
     * @return string
     */
    public function getPassw()
    {
        return $this->passw;
    }

    /**
     * Set idCliente
     *
     * @param integer $idCliente
     *
     * @return Usuario
     */
    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;

        return $this;
    }

    /**
     * Get idCliente
     *
     * @return integer
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    /**
     * Set eMail
     *
     * @param string $eMail
     *
     * @return Usuario
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
     * Set accWebPrivada
     *
     * @param boolean $accWebPrivada
     *
     * @return Usuario
     */
    public function setAccWebPrivada($accWebPrivada)
    {
        $this->accWebPrivada = $accWebPrivada;

        return $this;
    }

    /**
     * Get accWebPrivada
     *
     * @return boolean
     */
    public function getAccWebPrivada()
    {
        return $this->accWebPrivada;
    }

    /**
     * Set accWebExpoVirtual
     *
     * @param boolean $accWebExpoVirtual
     *
     * @return Usuario
     */
    public function setAccWebExpoVirtual($accWebExpoVirtual)
    {
        $this->accWebExpoVirtual = $accWebExpoVirtual;

        return $this;
    }

    /**
     * Get accWebExpoVirtual
     *
     * @return boolean
     */
    public function getAccWebExpoVirtual()
    {
        return $this->accWebExpoVirtual;
    }

    /**
     * Set accWebExpoReal
     *
     * @param boolean $accWebExpoReal
     *
     * @return Usuario
     */
    public function setAccWebExpoReal($accWebExpoReal)
    {
        $this->accWebExpoReal = $accWebExpoReal;

        return $this;
    }

    /**
     * Get accWebExpoReal
     *
     * @return boolean
     */
    public function getAccWebExpoReal()
    {
        return $this->accWebExpoReal;
    }

    /**
     * Set tipoUsuario
     *
     * @param string $tipoUsuario
     *
     * @return Usuario
     */
    public function setTipoUsuario($tipoUsuario)
    {
        $this->tipoUsuario = $tipoUsuario;

        return $this;
    }

    /**
     * Get tipoUsuario
     *
     * @return string
     */
    public function getTipoUsuario()
    {
        return $this->tipoUsuario;
    }

    /**
     * Set turnoComida
     *
     * @param string $turnoComida
     *
     * @return Usuario
     */
    public function setTurnoComida($turnoComida)
    {
        $this->turnoComida = $turnoComida;

        return $this;
    }

    /**
     * Get turnoComida
     *
     * @return string
     */
    public function getTurnoComida()
    {
        return $this->turnoComida;
    }

    /**
     * Set estadoBloqueo
     *
     * @param string $estadoBloqueo
     *
     * @return Usuario
     */
    public function setEstadoBloqueo($estadoBloqueo)
    {
        $this->estadoBloqueo = $estadoBloqueo;

        return $this;
    }

    /**
     * Get estadoBloqueo
     *
     * @return string
     */
    public function getEstadoBloqueo()
    {
        return $this->estadoBloqueo;
    }

    /**
     * Set tsBloqueo
     *
     * @param \DateTime $tsBloqueo
     *
     * @return Usuario
     */
    public function setTsBloqueo($tsBloqueo)
    {
        $this->tsBloqueo = $tsBloqueo;

        return $this;
    }

    /**
     * Get tsBloqueo
     *
     * @return \DateTime
     */
    public function getTsBloqueo()
    {
        return $this->tsBloqueo;
    }

    /**
     * Set renovacionPass
     *
     * @param \DateTime $renovacionPass
     *
     * @return Usuario
     */
    public function setRenovacionPass($renovacionPass)
    {
        $this->renovacionPass = $renovacionPass;

        return $this;
    }

    /**
     * Get renovacionPass
     *
     * @return \DateTime
     */
    public function getRenovacionPass()
    {
        return $this->renovacionPass;
    }

    /**
     * Set acceso
     *
     * @param \DateTime $acceso
     *
     * @return Usuario
     */
    public function setAcceso($acceso)
    {
        $this->acceso = $acceso;

        return $this;
    }

    /**
     * Get acceso
     *
     * @return \DateTime
     */
    public function getAcceso()
    {
        return $this->acceso;
    }

    /**
     * Set idAsociado
     *
     * @param \BackBundle\Entity\Asociados $idAsociado
     *
     * @return Usuario
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

    /**
     * Set idProveedor
     *
     * @param \BackBundle\Entity\Proveedores $idProveedor
     *
     * @return Usuario
     */
    public function setIdProveedor(\BackBundle\Entity\Proveedores $idProveedor = null)
    {
        $this->idProveedor = $idProveedor;

        return $this;
    }

    /**
     * Get idProveedor
     *
     * @return \BackBundle\Entity\Proveedores
     */
    public function getIdProveedor()
    {
        return $this->idProveedor;
    }
}
