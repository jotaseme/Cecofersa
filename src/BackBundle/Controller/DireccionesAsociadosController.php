<?php

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;

class DireccionesAsociadosController extends Controller
{
    /**
     * @Route("/Admin/asociados/{id_asociado}/edit-direccion",name="update_post_direccion_asociado", requirements={"id_asociado": "\d+"})
     * @Method({"POST"})
     */
    public function updatePOSTFamiliasAsociadoAction(Request $request,$id_asociado)
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
}
