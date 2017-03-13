<?php

namespace BackBundle\Controller;

use BackBundle\Form\AsociadosType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;


class AsociadosController extends Controller
{
    private $user_session;

    public function __construct()
    {
        $this->user_session = new Session();
    }
    /**
     * @Route("/Admin/asociados/")
     * @Route("/Admin/asociados/{filter}", name="asociados", defaults={"filter" = null})
     */
    public function indexAction($filter=null)
    {
        if(is_numeric($filter)){
            $response = $this->forward('BackBundle:Asociados:detalle', array(
                'id_asociado'  => $filter,
            ));
            return $response;
        }
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
        if(!$asociado){
            throw $this->createNotFoundException(
                'Error en la busqueda del asociado '
            );
        }
        return $this->render('Backoffice/Asociados/detalle_asociado.html.twig', [
            'asociado'=>$asociado
        ]);
    }

    /**
     * @Route("/Admin/asociados/{id_asociado}/edit",name="edit_asociado", requirements={"id_asociado": "\d+"})
     * @Method({"GET"})
     */
    public function editAsociadoAction($id_asociado)
    {
        $asociado = $this->getDoctrine()
            ->getRepository('BackBundle:Asociados')
            ->find($id_asociado);

        $form_asociado = $this->createForm(AsociadosType::class, $asociado);
        $form_asociado->get('provincia')->setData(ucfirst(strtolower($asociado->getProvincia())));

        if(!$asociado){
            throw $this->createNotFoundException(
                'Error en la busqueda del asociado '
            );
        }
        return $this->render('Backoffice/Asociados/edit_asociado.html.twig', [
            'asociado'=>$asociado,
            'form'=>$form_asociado->createView()
        ]);

    }

    /**
     * @Route("/Admin/asociados/{id_asociado}/edit",name="edit_post_asociado", requirements={"id_asociado": "\d+"})
     * @Method({"POST"})
     */
    public function editPOSTAsociadoAction(Request $request,$id_asociado)
    {
        $asociado = $this->getDoctrine()
            ->getRepository('BackBundle:Asociados')
            ->find($id_asociado);
        $form = $this->createForm(AsociadosType::class, $asociado);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                /* Datos del formulario */
                $asociado->setFechaEdicion(new \DateTime("now"));
                $this->getDoctrine()->getManager()->persist($asociado);
                $this->getDoctrine()->getManager()->flush();
                $status = '¡Asociado actualizado correctamente!';
            } else {
                $status = '¡Ha ocurrido un error! ¡Formulario invalido!';
            }
        } else {
            $status = '¡Ha ocurrido un error! ¡Formulario no enviado!';
        }
        $this->user_session->getFlashBag()
            ->add('status', $status);
        return $this->render('Backoffice/Asociados/detalle_asociado.html.twig', [
            'asociado'=>$asociado
        ]);
    }

    /**
     * @Route("/Admin/upload_image",options = { "expose" = true }, name="upload_image_asociado")
     * @Method({"POST"})
     */
    public function uploadImageAsociado(Request $request)
    {
        $id_asociado = $request->query->get('id');
        $file = $request->files;
        $file = $file->get('kartik-input-705')[0];
        if(!empty($file) && $file != null) {
            $file_name = "1".'_'.time().'.'."jpg";
            $file->move('img/Back/logos/',$file_name);
        }
    }
}
