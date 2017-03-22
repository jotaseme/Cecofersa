<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{
    /**
     * @Route("/{languaje}", name="index")
     */
    public function indexAction($languaje='es')
    {
        $asociados = $this->getDoctrine()
            ->getRepository('BackBundle:Asociados')
            ->findAllOrderedByNameRelacionAsociados('Portugal');
        return $this->render('Cecofersa/encabezado.html.twig',
            ['languaje' => $languaje
        ]);

    }
}
