<?php

namespace BackBundle\Controller;

use BackBundle\Entity\UsuarioProveedor;
use BackBundle\Form\UsuarioProveedorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;

class UsuarioProveedorController extends Controller
{

    private $user_session;

    public function __construct()
    {
        $this->user_session = new Session();
    }

    /**
     *
     * @Route("/Admin/proveedores/{id_proveedor}/{id_usuario}/edit", name="update_usuario_proveedor")
     * @Method({"POST"})
     */
    public function updateUsuarioProveedorAction(Request $request)
    {
        $id_usuario = $request->get('pk');
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('BackBundle:UsuarioProveedor')->find($id_usuario);
        if($usuario){
            if($request->get('name')=='email'){
                // Comprobar que ese correo no esta dado de alta ya en la base de datos
                $email = $request->get('value');
                $usuarioByEmail = $em->getRepository('BackBundle:UsuarioProveedor')->findBy(array('email'=>$email));
                if($usuarioByEmail){
                    $response = array("status" => "error", "msg"=>"¡Ya existe un usuario con ese email!");
                    return new Response(json_encode($response));
                }else{
                    $usuario->setEMail($email);

                }
            }elseif($request->get('name')=='login'){
                $login = $request->get('value');
                $usuarioByLogin = $em->getRepository('BackBundle:UsuarioProveedor')->findBy(array('login'=>$login));
                if($usuarioByLogin){
                    $response = array("status" => "error", "msg"=>"¡Ya existe un usuario con ese login!");
                    return new Response(json_encode($response));
                }else{
                    $usuario->setLogin(strtoupper($login));
                }
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
            $usuario->setUpdateAt(new \DateTime('now'));
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
     * @Route("/Admin/proveedores/{id_proveedor}/usuario/create", name="create_usuario_proveedor",
     *     options = { "expose" = true },
     *  )
     * @Method({"POST"})
     */
    public function createUsuarioAction(Request $request, $id_proveedor)
    {
        $usuario = new UsuarioProveedor();
        $form = $this->createForm(UsuarioProveedorType::class, $usuario);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            if ($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $proveedor = $em->getRepository('BackBundle:Proveedores')->find($id_proveedor);
                $usuarioByEmail = $em->getRepository('BackBundle:UsuarioProveedor')->findBy(array('email'=>$usuario->getEmail()));
                $usuarioByLogin = $em->getRepository('BackBundle:UsuarioProveedor')->findBy(array('login'=>$usuario->getLogin()));
                if($usuarioByEmail){
                    $status = '¡Ya existe un usuario con ese email!';
                    $this->user_session->getFlashBag()
                        ->add('status', $status);
                    return $this->redirect("/Admin/proveedor/$id_proveedor");
                }
                if($usuarioByLogin){
                    $status = '¡Ya existe un usuario con ese Login!';
                    $this->user_session->getFlashBag()
                        ->add('status', $status);
                    return $this->redirect("/Admin/proveedor/$id_proveedor");
                }
                if(!isset($proveedor)){
                    $status = '¡Ha ocurrido un error!';
                }else{

                    $usuario->setIdProveedor($proveedor);
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

        return $this->redirect("/Admin/proveedores/$id_proveedor");
    }


    /**
     * @Route("/Admin/proveedores/{id_proveedor}/{id_usuario}/delete", name="delete_usuario_proveedor",
     *     options = { "expose" = true },
     *  )
     * @Method({"POST"})
     */
    public function deleteUsuarioAction(Request $request)
    {
        $id_usuario = $request->get('id_usuario');
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('BackBundle:UsuarioProveedor')->find($id_usuario);
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