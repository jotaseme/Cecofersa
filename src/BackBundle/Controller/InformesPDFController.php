<?php

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class InformesPDFController extends Controller
{
    /**
     * @Route("/Admin/asociados/relacion-empresas/todos", name="relacionEmpresasToPdf")
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
     * @Route("/Admin/asociados/relacion-empresas/portugal", name="relacionEmpresasPortugalToPdf")
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
     * @Route("/Admin/asociados/etiquetas", name="etiquetasToPdf")
     */
    public function etiquetasToPDFAction()
    {
        $asociados = $this->getDoctrine()
            ->getRepository('BackBundle:Asociados')
            ->findAllOrderedByNameRelacionAsociados('Todos');

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($this->renderView(
                'Backoffice/PDF/etiquetas.twig',
                array(
                    'asociados'=>$asociados
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
