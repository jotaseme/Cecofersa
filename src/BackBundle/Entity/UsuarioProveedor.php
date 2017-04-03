<?php

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioProveedor
 *
 * @ORM\Table(name="usuario_proveedor", indexes={@ORM\Index(name="fk_proveedor_usuario_idx", columns={"id_proveedor"})})
 * @ORM\Entity
 */
class UsuarioProveedor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_usuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=20, nullable=true)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=50, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var boolean
     *
     * @ORM\Column(name="acceso_web_expo_virtual", type="boolean", nullable=true)
     */
    private $accesoWebExpoVirtual;

    /**
     * @var boolean
     *
     * @ORM\Column(name="acceso_web_expo_real", type="boolean", nullable=true)
     */
    private $accesoWebExpoReal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="renovacion_pass", type="datetime", nullable=true)
     */
    private $renovacionPass;

    /**
     * @var boolean
     *
     * @ORM\Column(name="turno_comida", type="boolean", nullable=true)
     */
    private $turnoComida;

    /**
     * @var \Proveedores
     *
     * @ORM\ManyToOne(targetEntity="Proveedores",inversedBy="usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_proveedor", referencedColumnName="ID_PROVEEDOR")
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
     * @return UsuarioProveedor
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
     * Set password
     *
     * @param string $password
     *
     * @return UsuarioProveedor
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return UsuarioProveedor
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set accesoWebExpoVirtual
     *
     * @param boolean $accesoWebExpoVirtual
     *
     * @return UsuarioProveedor
     */
    public function setAccesoWebExpoVirtual($accesoWebExpoVirtual)
    {
        $this->accesoWebExpoVirtual = $accesoWebExpoVirtual;

        return $this;
    }

    /**
     * Get accesoWebExpoVirtual
     *
     * @return boolean
     */
    public function getAccesoWebExpoVirtual()
    {
        return $this->accesoWebExpoVirtual;
    }

    /**
     * Set accesoWebExpoReal
     *
     * @param boolean $accesoWebExpoReal
     *
     * @return UsuarioProveedor
     */
    public function setAccesoWebExpoReal($accesoWebExpoReal)
    {
        $this->accesoWebExpoReal = $accesoWebExpoReal;

        return $this;
    }

    /**
     * Get accesoWebExpoReal
     *
     * @return boolean
     */
    public function getAccesoWebExpoReal()
    {
        return $this->accesoWebExpoReal;
    }

    /**
     * Set renovacionPass
     *
     * @param \DateTime $renovacionPass
     *
     * @return UsuarioProveedor
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
     * Set turnoComida
     *
     * @param boolean $turnoComida
     *
     * @return UsuarioProveedor
     */
    public function setTurnoComida($turnoComida)
    {
        $this->turnoComida = $turnoComida;

        return $this;
    }

    /**
     * Get turnoComida
     *
     * @return boolean
     */
    public function getTurnoComida()
    {
        return $this->turnoComida;
    }

    /**
     * Set idProveedor
     *
     * @param \BackBundle\Entity\Proveedores $idProveedor
     *
     * @return UsuarioProveedor
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
