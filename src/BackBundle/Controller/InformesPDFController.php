<?php

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class InformesPDFController extends Controller
{
    /**
     * @Route("/Admin/asociados/pdf/relacion-empresas/todos", name="relacionEmpresasToPdf")
     */
    public function relacionEmpresasToPDFAction()
    {
        $asociados = $this->getDoctrine()
            ->getRepository('BackBundle:Asociados')
            ->findAllOrderedByNameRelacionAsociados('Todos');

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($this->renderView(
                'Backoffice/PDF/relacion de empresas.twig',
                array(
                    'asociados'=>$asociados
                )
            )),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="relacion_asociados.pdf"'
            )
        );
    }

    /**
     * @Route("/Admin/asociados/pdf/relacion-empresas/portugal", name="relacionEmpresasPortugalToPdf")
     */
    public function relacionEmpresasPortugalToPDFAction()
    {
        $asociados = $this->getDoctrine()
            ->getRepository('BackBundle:Asociados')
            ->findAllOrderedByNameRelacionAsociados('Portugal');

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($this->renderView(
                'Backoffice/PDF/relacion de empresas.twig',
                array(
                    'asociados' => $asociados
                )
            )),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="relacion_asociados_portugal.pdf"'
            )
        );
    }

    /**
     * @Route("/Admin/asociados/pdf/etiquetas", name="etiquetasToPdf")
     */
    public function etiquetasToPDFAction()
    {
        $direcciones = $this->getDoctrine()
            ->getRepository('BackBundle:DireccionesAsociados')
            ->findAllOrderedByNameEtiquetasAsociados('Todos');

        //var_dump($direcciones[0]);die;
        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($this->renderView(
                'Backoffice/PDF/etiquetas.twig',
                array(
                    'direcciones'=>$direcciones
                )
            )),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="etiquetas.pdf"'
            )
        );
    }
}
