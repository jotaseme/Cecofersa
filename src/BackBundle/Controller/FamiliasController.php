<?php

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;

class FamiliasController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * @Route("/Admin/Asociado/Familias/updateFromCsv", name="update_familias_asociado_csv",
     *     options = { "expose" = true })
     * @Method({"POST"})
     */
    public function updateFamiliasAsociadosFromCSVAction(Request $request){

        $file = $request->files;
        $file = $file->get('familias')[0];
        $fecha =  date_timestamp_get(date_create());
        if(!empty($file) && $file != null) {
            $file_name =  $fecha.'.csv';
            $file->move('ficheroCSV/Familias/',$file_name);

            $reader = $this->get('app.file_reader');
            $reader->updateFamilias($file_name);
            echo json_encode(['msg'=>'¡Success!']);
        }else{
            echo json_encode(['msg'=>'¡Ha ocurrido un error!']);
        }
        return new Response();
    }

    /**
     * @Route("/Admin/asociados/{id_asociado}/edit-familia",name="update_post_familia_asociado", requirements={"id_asociado": "\d+"})
     * @Method({"POST"})
     */
    public function updatePOSTFamiliasAsociadoAction(Request $request,$id_asociado)
    {
        $id_familiaAsociado = $request->get('pk');
        $em = $this->getDoctrine()->getManager();
        $familia_asociado = $em->getRepository('BackBundle:FamiliasAsociados')
            ->find($id_familiaAsociado);
        if(!$familia_asociado){
            $response = array("status" => "error", "msg"=>"¡Ha ocurrido un error 1!");
            return new Response(json_encode($response));
        }else{
            $volumen = $request->get('value');
            $familia_asociado->setVolumen($volumen);
            $em->persist($familia_asociado);
            $em->flush();
            $response = array("code" => 200, "success" => true);

            return new Response(json_encode($response));

        }
    }
}
