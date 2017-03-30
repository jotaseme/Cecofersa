<?php

namespace BackBundle\Controller;


use BackBundle\Entity\DireccionesAsociados;
use BackBundle\Entity\Usuario;
use BackBundle\Entity\UsuarioAsociado;
use BackBundle\Form\DireccionesAsociadosType;
use BackBundle\Form\UsuarioAsociadoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Ddeboer\DataImport\Reader\CsvReader;

ini_set('max_execution_time', 9200);

class ProveedoresController extends Controller
{
    private $user_session;

    public function __construct()
    {
        $this->user_session = new Session();
    }

    /**
     * @Route("/Admin/proveedores/{id}", name="detalle_proveedor")
     */
    public function detalleAction($id)
    {
        return $this->render('Backoffice/Proveedores/detalle_proveedor.html.twig',
            ['idproveedor' => $id,
        ]);
    }
}