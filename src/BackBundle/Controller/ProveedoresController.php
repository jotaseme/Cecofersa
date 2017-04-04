<?php

namespace BackBundle\Controller;


use BackBundle\Entity\DireccionesAsociados;
use BackBundle\Entity\Usuario;
use BackBundle\Entity\UsuarioAsociado;
use BackBundle\Entity\UsuarioProveedor;
use BackBundle\Form\DireccionesAsociadosType;
use BackBundle\Form\UsuarioProveedorType;
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

        if ($filter == 'activos'){
            $proveedores = $this->getDoctrine()
                ->getRepository('BackBundle:Proveedores')
                ->findBy(array('activo'=>'1'),array('proveedor'=>'ASC'));
        } elseif ($filter == 'inactivos'){
            $proveedores = $this->getDoctrine()
                ->getRepository('BackBundle:Proveedores')
                ->findBy(array('activo'=>'0'),array('proveedor'=>'ASC'));
        } else {
            $proveedores = $this->getDoctrine()
                ->getRepository('BackBundle:Proveedores')
                ->findBy(array(),array('proveedor'=>'ASC'));
        }



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

        $usuario = new UsuarioProveedor();
        $form_usuarioProveedor = $this->createForm(UsuarioProveedorType::class, $usuario);

        $array_provincias = ['Álava','Albacete','Alicante','Almería','Asturias','Avila','Badajoz','Barcelona','Burgos','Cáceres',
            'Cádiz','Cantabria','Castellón','Ciudad Real','Córdoba','La Coruña','Cuenca','Gerona','Granada','Guadalajara',
            'Guipúzcoa','Huelva','Huesca','Islas Baleares','Jaén','León','Lérida','Lugo','Madrid','Málaga','Murcia','Navarra',
            'Orense','Palencia','Las Palmas','Pontevedra','La Rioja','Salamanca','Segovia','Sevilla','Soria','Tarragona',
            'Santa Cruz de Tenerife','Teruel','Toledo','Valencia','Valladolid','Vizcaya','Zamora','Zaragoza','Ceuta',
            'Melilla','Lisboa','Leiria','Santarém','Setúbal','Beja','Faro','Ávora','Portalegre','Castelo Branco',
            'Guarda','Coimbra','Aveiro','Viseu','Braganza','Vila Real','Porto','Braga','Viana do Castelo','Horta (Azores)'];

        $form_usuarioProveedor->get('idProveedor')->setData($id_proveedor);

        return $this->render('Backoffice/Proveedores/detalle_proveedor.html.twig',
            ['proveedor' => $proveedor,
             'array_provincias'=>json_encode($array_provincias),
             'form' => $form_usuarioProveedor->createView()]);
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
            }elseif($request->get('name') == 'responsable-convenio-proveedor'){
                $responsable = $request->get('value');
                $proveedor->setResponsableConvenio($responsable);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'email-responsable-convenio-proveedor'){
                $emailResponsable = $request->get('value');
                $proveedor->setEmailConvenio($emailResponsable);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'telefono-proveedor'){
                $telefono = $request->get('value');
                $proveedor->setTelefono($telefono);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'fax-proveedor'){
                $fax = $request->get('value');
                $proveedor->setFax($fax);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'pagina-web-proveedor'){
                $paginaWeb = $request->get('value');
                $proveedor->setPaginaWeb($paginaWeb);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'cargo-responsable-convenio-proveedor'){
                $cargoResponsableConvenio = $request->get('value');
                $proveedor->setCargoConvenio($cargoResponsableConvenio);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'convenio-proveedor'){
                $convenio = $request->get('value');
                $proveedorByConvenio = $em->getRepository('BackBundle:Proveedores')->findBy(array('convenioColaboracion'=>$convenio));
                if($proveedorByConvenio){
                    $response = array("status" => "error", "msg"=>"¡Ya existe un proveedor con ese identificador de convenio!");
                    return new Response(json_encode($response));
                }else{
                    $proveedor->setConvenioColaboracion($convenio);
                    $proveedor->getFechaEdicion(new \DateTime('now'));
                }
            }elseif($request->get('name') == 'fecha-convenio-proveedor'){
                $fechaConvenio = $request->get('value');
                $proveedor->setFechaConvenio( \DateTime::createFromFormat('d/m/Y', $fechaConvenio));
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'vigencia-proveedor'){
                $vigencia = $request->get('value');
                $proveedor->setVigencia($vigencia);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'precio-proveedor'){
                $precio = $request->get('value');
                $proveedor->setPrecios($precio);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'descuentos-factura-proveedor'){
                $descuentoFactura = $request->get('value');
                $proveedor->setDescuentosFactura($descuentoFactura);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'iva-precio-proveedor'){
                $ivaPrecio = $request->get('value');
                $proveedor->setIva($ivaPrecio);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'gestion-centralizada-proveedor'){
                $gestionCentralizada = $request->get('value');
                $proveedor->setGestionCentralizada($gestionCentralizada);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'forma-pago-proveedor'){
                $formaPago = $request->get('value');
                $proveedor->setFormaPago($formaPago);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'pronto-pago-proveedor'){
                $prontoPago = $request->get('value');
                $proveedor->setProntoPago($prontoPago);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'pedido-minimo-proveedor'){
                $pedidoMinimo = $request->get('value');
                $proveedor->setPedidoMinimo($pedidoMinimo);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'portes-peninsula-proveedor'){
                $portesPeninsula = $request->get('value');
                $proveedor->setPortesPeninsula($portesPeninsula);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'portes-portugal-proveedor'){
                $portesPortugal = $request->get('value');
                $proveedor->setPortugal($portesPortugal);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'portes-canarias-proveedor'){
                $portesCanarias = $request->get('value');
                $proveedor->setCanarias($portesCanarias);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'portes-baleares-proveedor'){
                $portesBaleares = $request->get('value');
                $proveedor->setBaleares($portesBaleares);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'portes-ceuta-melilla-proveedor'){
                $portesCeutaMelilla = $request->get('value');
                $proveedor->setCeutaMelilla($portesCeutaMelilla);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'articulos-comercializa-proveedor'){
                $articulosComercializa = $request->get('value');
                $proveedor->setArticulosComercializa($articulosComercializa);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'rappel-cecofersa-proveedor'){
                $rappelCecofersa = $request->get('value');
                $proveedor->setRappelCecofersa($rappelCecofersa);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'rappel-asociado-proveedor'){
                $rappelAsociado = $request->get('value');
                $proveedor->setRappelAsociado($rappelAsociado);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'observaciones-proveedor'){
                $observaciones = $request->get('value');
                $proveedor->setObservaciones($observaciones);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'publicidad-proveedor'){
                $publicidad = $request->get('value');
                $proveedor->setPublicidad($publicidad);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'expocecofersa-proveedor'){
                $expocecofersa = $request->get('value');
                $proveedor->setExpocecofersa($expocecofersa);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'gestor-proveedor'){
                $gestor = $request->get('value');
                $proveedor->setGestor($gestor);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'fechabaja-proveedor'){
                $fechaBaja = (new \DateTime($request->get('value')));
                $proveedor->setFechaBaja($fechaBaja);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }elseif($request->get('name') == 'nombrecomercial-proveedor'){
                $comercial = $request->get('value');
                $proveedor->setNombreComercial($comercial);
                $proveedor->setFechaEdicion(new \DateTime('now'));
            }else{
                $response = array("status" => "error", "msg"=>"¡Ha ocurrido un error!");
                return new Response(json_encode($response));
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
    ############# LEER CSV usuarioProveedor ##################

//    public function leerProveedoresAction(){
//
//        $file = new \SplFileObject('../web/ficheroCSV/usuariosProveedores.csv');
//        $reader = new CsvReader($file, ';');
//        $reader->setHeaderRowNumber(0);
//        foreach ($reader as $row) {
//            $id_proveedor = $row['ID_PROVEEDOR'];
//            $proveedor = $this->getDoctrine()
//                ->getRepository('BackBundle:Proveedores')
//                ->findBy(array('idProveedor'=>$id_proveedor));
//            if($proveedor){
//                $usuario = new UsuarioProveedor();
//                $usuario->setIdProveedor($proveedor[0]);
//                $usuario->setLogin(utf8_encode(trim($row['LOGIN'])));
//                $usuario->setPassword(utf8_encode(trim($row['PASSW'])));
//                $usuario->setEmail(utf8_encode(trim($row['E_MAIL'])));
//                $usuario->setAccesoWebExpoVirtual($row['ACC_WEB_EXPO_VIRTUAL']);
//                $usuario->setAccesoWebExpoReal($row['ACC_WEB_EXPO_REAL']);
//                $usuario->setRenovacionPass(new \DateTime('now'));
//
//                $this->getDoctrine()->getManager()
//                    ->persist($usuario);
//            }else{
//                print_r($row['ID_PROVEEDOR']." " . "<br/>");
//            }
//
//        }
//
//        $this->getDoctrine()->getManager()
//            ->flush();
//        echo "FIN";
//        die;
//    }
}

