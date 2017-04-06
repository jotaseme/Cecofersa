<?php

namespace BackBundle\Controller;

use BackBundle\Entity\FicherosProveedor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class FicherosController extends Controller
{
    /**
     * @Route("/Admin/ficheros", name="ficheros")
     */
    public function indexAction()
    {
        return $this->render('Backoffice/Ficheros/index.html.twig', [

        ]);
    }

    /**
     * @Route("/Admin/Ficheros/update", name="fichero_update",
     *     options = { "expose" = true })
     * @Method({"POST"})
     */
    public function updateFicheroAction(Request $request)
    {
        $id_fichero = $request->get('id_fichero');
        $status = $request->get('status');

        $em = $this->getDoctrine()->getManager();
        if ($id_fichero!=null && $status!=null) {
            $fichero = $em->getRepository('BackBundle:Fichero')->find($id_fichero);
            if($status=="true"){
                $fichero->setFechaCaducidad(null);
                $fichero->setPublicado(1);
            }elseif($status=="false"){
                $fichero->setFechaCaducidad(new \DateTime('now'));
                $fichero->setPublicado(0);
            }else{
                $response = array("status" => "error", "msg"=>$id_fichero);
                return new Response(json_encode($response));
            }
            $em->persist($fichero);
            $em->flush();
            $response = array("status" => "OK", "msg"=>$id_fichero);
            return new Response(json_encode($response));
        }else{
            $response = array("status" => "error", "msg"=>$id_fichero);
            return new Response(json_encode($response));
        }
    }

    /**
     * @Route("/Admin/Ficheros/delete", name="fichero_delete",
     *     options = { "expose" = true })
     * @Method({"POST"})
     */
    public function deleteFicheroAction(Request $request)
    {
        $id_fichero = $request->get('id_fichero');
        $em = $this->getDoctrine()->getManager();
        $fichero = $em->getRepository('BackBundle:Fichero')->find($id_fichero);
        if(isset($fichero)){
            $fichero->setActivo(0);
            $em->persist($fichero);
            $em->flush();
            $response = array("code" => 200, "success" => true);
            return new Response(json_encode($response));
        }else{
            $response = array("code" => 404, "success" => false);
            return new Response(json_encode($response));
        }
    }

    /**
     * @Route("/Admin/ficheros_migracion", name="ficheros_migracion")
     */
    public function migracionAction()
    {
        $em = $this->getDoctrine()->getManager();
        /*$dql = "SELECT f
                  FROM BackBundle:Fichero f
                  WHERE f.path LIKE '%/ACUERDOS CON PROVEEDORES (PLANTILLAS)/%'
                  AND YEAR(f.fechaCreacion) > 2000";*/
        $dql = "SELECT f
                  FROM BackBundle:Fichero f
                  WHERE f.path LIKE '%/DESCARGA DE TARIFAS PROVEEDORES HOMOLOGADOS/%'
                  AND YEAR(f.fechaCreacion) > 2000";
        $ficheros = $em->createQuery($dql)->getResult();

        foreach($ficheros as $fichero){
            if ( preg_match('/\bMODELO\b/i',$fichero->getPath()))
                $tipo = 'Tarifa MODELO CECOFERSA';
            else
                $tipo = 'Tarifa MODELO ORIGINAL';
            $nombre_fichero = strstr($fichero->getNombre(), ' Tarifa', true).'%';

            $dql = "SELECT p.idProveedor, p.proveedor
                  FROM BackBundle:Proveedores p
                  WHERE p.proveedor LIKE '$nombre_fichero'";
            $id = $em->createQuery($dql)->getResult();
            if(sizeof($id)==1){
                $fichero->setIdProveedor($id[0]['idProveedor']);
                $fichero->setTipo($tipo);
                $em->persist($fichero);
            }elseif(sizeof($id)>1){
                $nombre_new = strstr($fichero->getNombre(), ' ', true);
                $nombre_fichero = substr($fichero->getNombre(), 0, strlen($nombre_new) + 3);
                $nombre_fichero = $nombre_fichero.'%';
                $dql = "SELECT p.idProveedor, p.proveedor
                  FROM BackBundle:Proveedores p
                  WHERE p.proveedor LIKE '$nombre_fichero'";
                $id = $em->createQuery($dql)->getResult();
                if(sizeof($id)==1){
                    $fichero->setIdProveedor($id[0]['idProveedor']);
                    $fichero->setTipo($tipo);
                    $em->persist($fichero);
                }else{
                    var_dump("ERROR 1");
                    var_dump($id);
                    var_dump($fichero->getIdFichero());
                }

            }else{
                var_dump("ERROR 2");
                var_dump($nombre_fichero);
                var_dump($fichero->getIdFichero());

            }
        }
        $em->flush();
        die;
    }
}
