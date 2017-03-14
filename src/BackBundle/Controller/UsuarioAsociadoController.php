<?php

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;

class UsuarioAsociadoController extends Controller
{
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
}
