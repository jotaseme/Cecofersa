<?php

namespace BackBundle\Controller;

use BackBundle\Entity\FicherosProveedor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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
                  WHERE f.path LIKE '%/TARIFAS PROVEEDORES HOMOLOGADOS 2016/%'
                  AND YEAR(f.fechaCreacion) > 2000";
        $ficheros = $em->createQuery($dql)->getResult();

        foreach($ficheros as $fichero){
            $nombre_fichero = strstr($fichero->getNombre(), ' ', true).'%';
            $dql = "SELECT p.idProveedor, p.proveedor
                  FROM BackBundle:Proveedores p
                  WHERE p.proveedor LIKE '$nombre_fichero'";
            $id = $em->createQuery($dql)->getResult();
            if(sizeof($id)==1){
                $fichero->setIdProveedor($id[0]['idProveedor']);
                $fichero->setTipo("Plantilla");
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
                    $fichero->setTipo("Plantilla");
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
