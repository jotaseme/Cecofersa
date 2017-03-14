<?php

namespace BackBundle\Controller;

use BackBundle\Entity\Usuario;
use BackBundle\Form\AsociadosType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Ddeboer\DataImport\Reader\CsvReader;


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
        //TODO: poner el id del asociado al nombre de la foto para pisar la existente si la hubiera
        $id_asociado = $request->query->get('id');
        $file = $request->files;
        $file = $file->get('kartik-input-705')[0];
        $ext = $file->guessExtension();
        if(!empty($file) && $file != null) {
            $file_name = $id_asociado.'.'.$ext;
            $file->move('img/Back/logos/',$file_name);
        }
        echo json_encode(['msg'=>'¡Success!']);

        return new Response();
    }

    /**
     * @Route("/Admin/leerFichero", name="leer_fichero")
     * @Method({"GET"})
     */
    public function leerAsociadosAction(){
        $file = new \SplFileObject('../web/ficheroCSV/asociados.csv');
        $reader = new CsvReader($file, ';');
        $reader->setHeaderRowNumber(0);
        foreach ($reader as $row) {
            $id_asociado = $row['ID_ASOCIADO'];
            if($id_asociado != null){
                $asociado = $this->getDoctrine()
                    ->getRepository('BackBundle:Asociados')
                    ->find($id_asociado);
                if($asociado!=null){
                    $usuario = new Usuario();
                    $usuario->setIdUsuario($row['ID_USUARIO']);
                    $usuario->setLogin($row['LOGIN']);
                    $usuario->setPassw($row['PASSW']);
                    $usuario->setIdCliente($row['ID_CLIENTE']);
                    $usuario->setEMail($row['E_MAIL']);
                    $usuario->setAccWebPrivada($row['ACC_WEB_PRIVADA']);
                    $usuario->setAccWebExpoVirtual($row['ACC_WEB_EXPO_VIRTUAL']);
                    $usuario->setAccWebExpoReal($row['ACC_WEB_EXPO_REAL']);
                    $usuario->setEstadoBloqueo($row['ESTADO_BLOQUEO']);

                    if($row['TS_BLOQUEO']!="NULL" && $row['TS_BLOQUEO'] != null){
                        $usuario->setTsBloqueo(new \DateTime($row['TS_BLOQUEO']));
                    }
                    if($row['RENOVACION_PASS'] != "NULL" && $row['RENOVACION_PASS'] != null){
                        $usuario->setRenovacionPass(new \DateTime($row['RENOVACION_PASS']));
                    }
                    $usuario->setIdAsociado($asociado);
                    $this->getDoctrine()->getManager()->persist($usuario);
                    $this->getDoctrine()->getManager()->flush();
                }
            }
        }
        die;
    }
}
