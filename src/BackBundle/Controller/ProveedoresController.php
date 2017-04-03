<?php

namespace BackBundle\Controller;


use BackBundle\Entity\DireccionesAsociados;
use BackBundle\Entity\Usuario;
use BackBundle\Entity\UsuarioAsociado;
use BackBundle\Form\DireccionesAsociadosType;
use BackBundle\Form\UsuarioAsociadoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Ddeboer\DataImport\Reader\CsvReader;

ini_set('max_execution_time', 9200);

class ProveedoresController extends Controller
{
    private $user_session;

    public function __construct()
    {
        $this->user_session = new Session();
    }

    /**
     * @Route("/Admin/proveedores/")
     * @Route("/Admin/proveedores/{filter}", name="proveedores", defaults={"filter" = null})
     */
    public function indexAction($filter=null)
    {
        if(is_numeric($filter)){
            $response = $this->forward('BackBundle:Proveedores:detalle', array(
                'id_proveedor'  => $filter,
            ));
            return $response;
        }
        $proveedores = $this->getDoctrine()
            ->getRepository('BackBundle:Proveedores')
            ->findAll();


        return $this->render('Backoffice/Proveedores/index1.html.twig', [
            'proveedores'=>$proveedores,
            'filter'=>$filter
        ]);
    }

    /**
     * @Route("/Admin/Proveedor/updateFromCsv", name="update_proveedor_csv",
     *     options = { "expose" = true })
     * @Method({"POST"})
     */
    public function updateProveedoresFromCSVAction(Request $request)
    {
        $file = $request->files;
        $file = $file->get('proveedores')[0];
        $fecha =  date_timestamp_get(date_create());
        if(!empty($file) && $file != null) {
            $file_name =  $fecha.'.csv';
            $file->move('ficheroCSV/Proveedores/',$file_name);

            $reader = $this->get('app.file_reader');
            $reader->updateProveedoresFromCsv($file_name);
            echo json_encode(['msg'=>'¡Success!']);
        }else{
            echo json_encode(['msg'=>'¡Ha ocurrido un error!']);
        }
        return new Response();
    }

    /**
     * @Route("/Admin/proveedores/{id_proveedor}", name="detalle_proveedor")
     */
    public function detalleAction($id_proveedor)
    {
        $proveedor = $this->getDoctrine()
            ->getRepository('BackBundle:Proveedores')
            ->find($id_proveedor);

        $array_provincias = ['Álava','Albacete','Alicante','Almería','Asturias','Avila','Badajoz','Barcelona','Burgos','Cáceres',
            'Cádiz','Cantabria','Castellón','Ciudad Real','Córdoba','La Coruña','Cuenca','Gerona','Granada','Guadalajara',
            'Guipúzcoa','Huelva','Huesca','Islas Baleares','Jaén','León','Lérida','Lugo','Madrid','Málaga','Murcia','Navarra',
            'Orense','Palencia','Las Palmas','Pontevedra','La Rioja','Salamanca','Segovia','Sevilla','Soria','Tarragona',
            'Santa Cruz de Tenerife','Teruel','Toledo','Valencia','Valladolid','Vizcaya','Zamora','Zaragoza','Ceuta',
            'Melilla','Lisboa','Leiria','Santarém','Setúbal','Beja','Faro','Ávora','Portalegre','Castelo Branco',
            'Guarda','Coimbra','Aveiro','Viseu','Braganza','Vila Real','Porto','Braga','Viana do Castelo','Horta (Azores)'];

        return $this->render('Backoffice/Proveedores/detalle_proveedor.html.twig',
            ['proveedor' => $proveedor, 'array_provincias'=>json_encode($array_provincias)]);
    }
    /**
     * @Route("/Admin/proveedores/{id_proveedor}/plantilla", name="PDFplantilla")
     */
    public function plantillaToPDFAction($id_proveedor)
    {
        $proveedor = $this->getDoctrine()
            ->getRepository('BackBundle:Proveedores')
            ->find($id_proveedor);

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($this->renderView(
                'Backoffice/Proveedores/plantilla.html.twig',
                array(
                    'proveedor'=>$proveedor
                )
            )),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="plantilla.pdf"'
            )
        );
    }

    /**
     * @Route("/Admin/proveedores/{id_proveedor}/ficha", name="PDFficha")
     */
    public function fichaToPDFAction($id_proveedor)
    {
        $proveedor = $this->getDoctrine()
            ->getRepository('BackBundle:Proveedores')
            ->find($id_proveedor);

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($this->renderView(
                'Backoffice/Proveedores/ficha.html.twig',
                array(
                    'proveedor'=>$proveedor
                )
            )),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="ficha.pdf"'
            )
        );
    }


    /**
     * @Route("/Admin/Proveedor/update", name="proveedor_update",
     *     options = { "expose" = true })
     * @Method({"POST"})
     */
    public function updateProveedoresAction(Request $request)
    {
        $id_proveedor = $request->get('pk');
        $em = $this->getDoctrine()->getManager();
        $proveedor = $em->getRepository('BackBundle:Proveedores')->find($id_proveedor);
        if($proveedor) {
            if ($request->get('name') == 'nombre-proveedor') {
                $nombre_proveedor = $request->get('value');
                $proveedor->setProveedor($nombre_proveedor);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'nif-proveedor'){
                $nif = $request->get('value');
                $proveedorByNif = $em->getRepository('BackBundle:Proveedores')->findBy(array('nif'=>$nif));
                if($proveedorByNif){
                    $response = array("status" => "error", "msg"=>"¡Ya existe un proveedor con ese NIF!");
                    return new Response(json_encode($response));
                }else{
                    $proveedor->setNif($nif);
                    $proveedor->getFechaEdicion(new \DateTime('now'));
                }
            }elseif($request->get('name') == 'direccion-proveedor'){
                $direccion_proveedor = $request->get('value');
                $proveedor->setDireccion($direccion_proveedor);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'poblacion-proveedor'){
                $poblacion_proveedor = $request->get('value');
                $proveedor->setPoblacion($poblacion_proveedor);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'codigoPostal-proveedor'){
                $codigoPostal = $request->get('value');
                $proveedor->setCodigoPostal($codigoPostal);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'provincia-proveedor'){
                $provinciaProveedor = $request->get('value');
                $proveedor->setProvincia($provinciaProveedor);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }
            $em->persist($proveedor);
            $em->flush();
            $response = array("code" => 200, "success" => true);
            return new Response(json_encode($response));
        }else{
            $response = array("status" => "error", "msg"=>"¡Ha ocurrido un error!");
            return new Response(json_encode($response));
        }
    }
}