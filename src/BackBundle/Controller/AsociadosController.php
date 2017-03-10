<?php

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AsociadosController extends Controller
{
    /**
     * @Route("/admin/asociados")
     */
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
}
