<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="")
     */
    public function indexAction()
    {
        print_r("holas");die;
        return $this->render('', array('name' => $name));
    }
}
