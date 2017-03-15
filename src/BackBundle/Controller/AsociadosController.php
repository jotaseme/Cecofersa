<?php

namespace BackBundle\Controller;

use BackBundle\Entity\Descarga;
use BackBundle\Entity\Usuario;
use BackBundle\Entity\UsuarioAsociado;
use BackBundle\Form\AsociadosType;
use BackBundle\Form\UsuarioAsociadoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Ddeboer\DataImport\Reader\CsvReader;
ini_set('max_execution_time', 9200);

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
        $usuario = new UsuarioAsociado();
        $form_usuarioAsociado = $this->createForm(UsuarioAsociadoType::class, $usuario);

        if(strlen("".$asociado->getCodigoAsociado())==3){
            $codigo_asociado = "0".$asociado->getCodigoAsociado();
        }else{
            $codigo_asociado = $asociado->getCodigoAsociado();
        }

        $form_usuarioAsociado->get('idCliente')->setData($codigo_asociado);
        return $this->render('Backoffice/Asociados/detalle_asociado.html.twig', [
            'asociado'=>$asociado,
            'form' => $form_usuarioAsociado->createView()
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
        $asociado = $this->getDoctrine()
            ->getRepository('BackBundle:Asociados')
            ->find($id_asociado);
        if($asociado!=null){
            $file = $request->files;
            $file = $file->get('kartik-input-705')[0];
            $ext = $file->guessExtension();
            if(!empty($file) && $file != null) {
                $file_name = $id_asociado.'.'.'jpg';
                $file->move('img/Back/logos/',$file_name);
                $asociado->setLogotipo(1);
                $this->getDoctrine()->getManager()->persist($asociado);
                $this->getDoctrine()->getManager()->flush();
            }

            echo json_encode(['msg'=>'¡Success!']);

            return new Response();
        }else{
            echo son_encode(['msg'=>'¡Ha ocurrido un erro!']);
        }
    }

    /**
     * @Route("/Admin/leerFichero", name="leer_fichero")
     * @Method({"GET"})
     */
    public function leerAsociadosAction(){
        die;
        $file = new \SplFileObject('../web/ficheroCSV/descargas.csv');
        $reader = new CsvReader($file, ';');
        $reader->setHeaderRowNumber(0);
        $batchSize = 8000;
        $i=1;
        var_dump("HOLA");
        foreach ($reader as $row) {
            var_dump($row['ID_DESCARGA']."<br/>");
            $id_usuario = $row['USUARIO_ID_USUARIO'];
            $id_fichero = $row['FICHERO_ID_FICHERO'];
            if($id_usuario != null && $id_fichero!=null){
                $usuario = $this->getDoctrine()
                    ->getRepository('BackBundle:UsuarioAsociado')
                    ->find($id_usuario);

                $fichero = $this->getDoctrine()
                    ->getRepository('BackBundle:Fichero')
                    ->find($id_fichero);
                if($usuario && $fichero){
                    $descarga = new Descarga();

                    $descarga->setFicheroFichero($fichero);
                    $descarga->setUsuarioUsuario($usuario);
                    $descarga->setFecha(new \DateTime($row['FECHA']));

                    $this->getDoctrine()->getManager()->persist($descarga);

                    if (($i % $batchSize) == 0) {
                        $this->getDoctrine()->getManager()->flush();
                        $this->getDoctrine()->getManager()->clear();
                    }
                }else{
                    echo "NO ENTRA";
                }
            }else{
                echo "NO ENTRA";
            }
            $usuario = null;
            $fichero = null;
            $i++;
        }
        var_dump("ADIOS");
        $this->getDoctrine()->getManager()->flush();
        $this->getDoctrine()->getManager()->clear();
        echo "FIN";
        die;
    }
}
