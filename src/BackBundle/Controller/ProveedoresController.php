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


        return $this->render('Backoffice/Proveedores/index.html.twig', [
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

        return $this->render('Backoffice/Proveedores/detalle_proveedor.html.twig',
            ['proveedor' => $proveedor,
        ]);
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
}