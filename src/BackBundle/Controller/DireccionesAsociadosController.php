<?php

namespace BackBundle\Controller;

use BackBundle\Entity\DireccionesAsociados;
use BackBundle\Form\DireccionesAsociadosType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;

class DireccionesAsociadosController extends Controller
{
    private $user_session;

    public function __construct()
    {
        $this->user_session = new Session();
    }

    /**
     * @Route("/Admin/asociados/{id_asociado}/edit-direccion",name="update_post_direccion_asociado", requirements={"id_asociado": "\d+"})
     * @Method({"POST"})
     */
    public function updatePOSTDireccionesAsociadoAction(Request $request,$id_asociado)
    {
        $id_direccionAsociado= $request->get('pk');

        $em = $this->getDoctrine()->getManager();
        $direccion = $em->getRepository('BackBundle:DireccionesAsociados')
            ->find($id_direccionAsociado);
        if(!$direccion){
            $response = array("status" => "error", "msg"=>"¡Ha ocurrido un error 1!");
            return new Response(json_encode($response));
        }else{
            if($request->get('name')=='domicilio-direccion-asociado'){
                $direccion->setDomicilio($request->get('value'));
            }elseif($request->get('name')=='codigoPostal-direccion-asociado'){
                $direccion->setCodigoPostal($request->get('value'));
            }elseif($request->get('name')=='codigoPostal-direccion-asociado') {
                $direccion->setCodigoPostal($request->get('value'));
            }elseif($request->get('name')=='provincia-direccion-asociado'){
                    $direccion->setProvincia($request->get('value'));
            }elseif($request->get('name')=='comunidadAutonoma-direccion-asociado'){
                $direccion->setComunidadAutonoma($request->get('value'));
            }elseif($request->get('name')=='pais-direccion-asociado'){
                $direccion->setPais($request->get('value'));
            }elseif($request->get('name')=='telefono-direccion-asociado'){
                $direccion->setTelefono($request->get('value'));
            }elseif($request->get('name')=='fax-direccion-asociado'){
                $direccion->setFax($request->get('value'));
            }elseif($request->get('name')=='oficina-direccion-asociado'){
                $direccion->setOficina($request->get('value'));
            }elseif($request->get('name')=='tienda-direccion-asociado'){
                $direccion->setTienda($request->get('value'));
            }elseif($request->get('name')=='almacen-direccion-asociado'){
                $direccion->setAlmacen($request->get('value'));
            }elseif($request->get('name')=='privado-direccion-asociado'){
                $direccion->setPrivado($request->get('value'));
            }elseif($request->get('name')=='etiquetas-direccion-asociado'){
                $direccion->setEtiquetas($request->get('value'));
            }else{
                $response = array("status" => "error", "msg"=>"¡Ha ocurrido un error!");
                return new Response(json_encode($response));
            }

            $em->persist($direccion);
            $em->flush();
            $response = array("code" => 200, "success" => true);

            return new Response(json_encode($response));

        }
    }

    /**
     * @Route("/Admin/asociados/{id_asociado}/create-direccion",name="create_post_direccion_asociado", requirements={"id_asociado": "\d+"})
     * @Method({"POST"})
     */
    public function createDireccionAsociadoAction(Request $request,$id_asociado)
    {
        $direccion = new DireccionesAsociados();
        $form = $this->createForm(DireccionesAsociadosType::class, $direccion);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $asociado = $em->getRepository('BackBundle:Asociados')->find($id_asociado);
                $direccion->setIdasociado($asociado);
                $direccion->setUpdatedat(new \DateTime('now'));
                $direccion->setCreatedat(new \DateTime('now'));

                $em->persist($direccion);
                $em->flush();
                $status = '¡La direccion se ha creado correctamente!';
            }else{
                $status = '¡Ha ocurrido un error!';
            }
        }else{
            $status = '¡Ha ocurrido un error!';
        }

        $this->user_session->getFlashBag()
            ->add('status', $status);

        return $this->redirect("/Admin/asociados/$id_asociado");
    }

    /**
     * @Route("/Admin/asociados/{id_asociado}/direcciones/{id_direccion}/delete", name="delete_direccion_asociado",
     *     options = { "expose" = true },
     *  )
     * @Method({"POST"})
     */
    public function deleteDireccionAction(Request $request)
    {
        $id_direccion = $request->get('id_direccion');
        $em = $this->getDoctrine()->getManager();
        $direccion = $em->getRepository('BackBundle:DireccionesAsociados')->find($id_direccion);
        if(isset($direccion)){
            $em->remove($direccion);
            $em->flush();
            $response = array("code" => 200, "success" => true);
            return new Response(json_encode($response));
        }else{
            $response = array("code" => 404, "success" => false);
            return new Response(json_encode($response));
        }
    }
}
