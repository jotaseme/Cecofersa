<?php

namespace BackBundle\Controller;

use BackBundle\Entity\UsuarioAsociado;
use BackBundle\Form\UsuarioAsociadoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;

class UsuarioAsociadoController extends Controller
{

    private $user_session;

    public function __construct()
    {
        $this->user_session = new Session();
    }

    /**
     *
     * @Route("/Admin/asociados/{id_asociado}/{id_usuario}/edit", name="update_usuario_asociado")
     * @Method({"POST"})
     */
    public function updateUsuarioAsociadoAction(Request $request)
    {
        $id_usuario = $request->get('pk');
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('BackBundle:UsuarioAsociado')->find($id_usuario);
        if($usuario){
            if($request->get('name')=='email'){
                // Comprobar que ese correo no esta dado de alta ya en la base de datos
                $email = $request->get('value');
                $usuarioByEmail = $em->getRepository('BackBundle:UsuarioAsociado')->findBy(array('eMail'=>$email));
                if($usuarioByEmail){
                    $response = array("status" => "error", "msg"=>"¡Ya existe un usuario con ese email!");
                    return new Response(json_encode($response));
                }else{
                    $usuario->setEMail($email);

                }
            }elseif($request->get('name')=='login'){
                $login = $request->get('value');
                $usuarioByLogin = $em->getRepository('BackBundle:UsuarioAsociado')->findBy(array('login'=>$login));
                if($usuarioByLogin){
                    $response = array("status" => "error", "msg"=>"¡Ya existe un usuario con ese login!");
                    return new Response(json_encode($response));
                }else{
                    $usuario->setLogin(strtoupper($login));
                }
            }elseif($request->get('name')=='estadoBloqueo'){
                $estado_bloqueo = $request->get('value');
                $usuario->setEstadoBloqueo($estado_bloqueo);
            }
            elseif($request->get('name')=='areaPrivada'){
                $accesoPrivada = $request->get('value');
                $usuario->setAccWebPrivada($accesoPrivada);
            }
            elseif($request->get('name')=='expoVirtual'){
                $expoVirtual = $request->get('value');
                $usuario->setAccWebExpoVirtual($expoVirtual);
            }
            elseif($request->get('name')=='expoFisica'){
                $expoFisica = $request->get('value');
                $usuario->setAccWebExpoReal($expoFisica);
            }else{
                $response = array("status" => "error", "msg"=>"¡Ha ocurrido un error!");
                return new Response(json_encode($response));
            }

            $em->persist($usuario);
            $em->flush();
            $response = array("code" => 200, "success" => true);
            return new Response(json_encode($response));
        }else{
            $response = array("status" => "error", "msg"=>"¡Ha ocurrido un error!");
            return new Response(json_encode($response));
        }
    }

    /**
     * @Route("/Admin/asociados/{id_asociado}/usuario/create", name="create_usuario_asociado",
     *     options = { "expose" = true },
     *  )
     * @Method({"POST"})
     */
    public function createUsuarioAction(Request $request, $id_asociado)
    {
        $usuario = new UsuarioAsociado();
        $form = $this->createForm(UsuarioAsociadoType::class, $usuario);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            if ($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $asociado = $em->getRepository('BackBundle:Asociados')->find($id_asociado);
                $usuarioByEmail = $em->getRepository('BackBundle:UsuarioAsociado')->findBy(array('eMail'=>$usuario->getEMail()));
                $usuarioByLogin = $em->getRepository('BackBundle:UsuarioAsociado')->findBy(array('login'=>$usuario->getLogin()));
                if($usuarioByEmail){
                    $status = '¡Ya existe un usuario con ese email!';
                    $this->user_session->getFlashBag()
                        ->add('status', $status);
                    return $this->redirect("/Admin/asociados/$id_asociado");
                }
                if($usuarioByLogin){
                    $status = '¡Ya existe un usuario con ese Login!';
                    $this->user_session->getFlashBag()
                        ->add('status', $status);
                    return $this->redirect("/Admin/asociados/$id_asociado");
                }
                if(!isset($asociado)){
                    $status = '¡Ha ocurrido un error!';
                }else{
                    $usuario->setIdCliente($asociado->getCodigoAsociado());
                    $usuario->setEstadoBloqueo('Normal');
                    $usuario->setCreatedAt(new \DateTime('now'));
                    $usuario->setIdAsociado($asociado);
                    $em->persist($usuario);
                    $em->flush();
                    $status = '¡El usuario se ha creado correctamente!';
                }
            }else {
                $status = '¡Ha ocurrido un error!';
            }
        }
        else{
            $status = '¡Ha ocurrido un error!';
        }
        $this->user_session->getFlashBag()
                ->add('status', $status);

        return $this->redirect("/Admin/asociados/$id_asociado");
    }


    /**
     * @Route("/Admin/asociados/{id_asociado}/{id_usuario}/delete", name="delete_usuario_asociado",
     *     options = { "expose" = true },
     *  )
     * @Method({"POST"})
     */
    public function deleteUsuarioAction(Request $request)
    {
        $id_usuario = $request->get('id_usuario');
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('BackBundle:UsuarioAsociado')->find($id_usuario);
        if(isset($usuario)){
            $em->remove($usuario);
            $em->flush();
            $response = array("code" => 200, "success" => true);
            return new Response(json_encode($response));
        }else{
            $response = array("code" => 404, "success" => false);
            return new Response(json_encode($response));
        }
    }


    /**
     * @Route("/Admin/asociados/{id_asociado}/usuarios/{id_usuario}/", name="show_usuario_asociado")
     * @Method({"get"})
     */
    public function showUsuarioAction($id_asociado,$id_usuario)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('BackBundle:UsuarioAsociado')->find($id_usuario);
        if(!isset($usuario)){
            return $this->redirect("/Admin/asociados/$id_asociado");
        }


        $descargas_dia = $em->getRepository('BackBundle:Descarga')->findDownloadsLast24H($id_usuario);
        var_dump($descargas_dia);die;

        return $this->render('Backoffice/Asociados/detalle_usuario_asociado.html.twig', [
            'usuario'=>$usuario
        ]);
    }
}
