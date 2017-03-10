<?php

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AsociadosController extends Controller
{
    /**
     * @Route("/Admin/asociados",name="asociados")
     */
    public function indexAction()
    {
        return $this->render('Backoffice/default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
}
