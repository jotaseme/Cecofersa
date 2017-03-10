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
        $asociados = $this->getDoctrine()
            ->getRepository('BackBundle:Asociados')
            ->findAllOrderedByName();


        return $this->render('Backoffice/Asociados/index.html.twig', [
            'asociados'=>$asociados

        ]);
    }
}
