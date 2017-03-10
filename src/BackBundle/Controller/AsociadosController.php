<?php

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AsociadosController extends Controller
{
    /**
     * @Route("/Admin/asociados/{filter}",name="asociados")
     */
    public function indexAction($filter=null)
    {
        $asociados = $this->getDoctrine()
            ->getRepository('BackBundle:Asociados')
            ->findAllOrderedByName($filter);

        return $this->render('Backoffice/Asociados/index.html.twig', [
            'asociados'=>$asociados,
            'filter'=>$filter

        ]);
    }

    /**
     * @Route("/Admin/asociados/{id_asociado}",name="detalle_asociado", requirements={"id_asociado": "\d+"})
     */
    public function detalleAction($id_asociado)
    {
        $asociado = $this->getDoctrine()
            ->getRepository('BackBundle:Asociados')
            ->find($id_asociado);
        var_dump($asociado);die;
        if(!$asociado){
            throw $this->createNotFoundException(
                'Error en la busqueda del asociado '
            );
        }
        return $this->render('default/asociado.html.twig', [
            'asociado'=>$asociado
        ]);

    }
}
