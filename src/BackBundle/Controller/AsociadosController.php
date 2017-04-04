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

class AsociadosController extends Controller
{
    private $user_session;

    public function __construct()
    {
        $this->user_session = new Session();
    }
    /**
     * @Route("/Admin/asociados/")
     * @Route("/Admin/asociados/{filter}", name="asociados", defaults={"filter" = null})
     */
    public function indexAction($filter=null)
    {
        if(is_numeric($filter)){
            $response = $this->forward('BackBundle:Asociados:detalle', array(
                'id_asociado'  => $filter,
            ));
            return $response;
        }
        $asociados = $this->getDoctrine()
            ->getRepository('BackBundle:Asociados')
            ->findAllOrderedByName($filter);

        return $this->render('Backoffice/Asociados/index.html.twig', [
            'asociados'=>$asociados,
            'filter'=>$filter
        ]);
    }

    /**
     * @Route("/Admin/asociados/{id_asociado}",name="detalle_asociado", requirements={"id_asociado": "\d+"})
     */
    public function detalleAction($id_asociado)
    {
        $asociado = $this->getDoctrine()
            ->getRepository('BackBundle:Asociados')
            ->find($id_asociado);
        if(!$asociado){
            throw $this->createNotFoundException(
                'Error en la busqueda del asociado '
            );
        }

        $direcciones = $this->getDoctrine()
            ->getRepository('BackBundle:DireccionesAsociados')
            ->findBy(array('idasociado'=>$id_asociado));

        $familias =  $this->getDoctrine()
            ->getRepository('BackBundle:FamiliasAsociados')
            ->findAllOrderedByName($id_asociado);

        $bloque_familias = array_chunk($familias, 20);
        if(sizeof($familias)== 0){
            $familias1=null;
            $familias2=null;
        }else{
            $familias1 = $bloque_familias[0];
            $familias2 = $bloque_familias[1];
        }

        $usuario = new UsuarioAsociado();
        $form_usuarioAsociado = $this->createForm(UsuarioAsociadoType::class, $usuario);

        $direcciones_form = new DireccionesAsociados();
        $form_direccionesAsociado = $this->createForm(DireccionesAsociadosType::class, $direcciones_form);

        if(strlen("".$asociado->getCodigoAsociado())==3){
            $codigo_asociado = "0".$asociado->getCodigoAsociado();
        }else{
            $codigo_asociado = $asociado->getCodigoAsociado();
        }

        $array_provincias = ['Álava','Albacete','Alicante','Almería','Asturias','Avila','Badajoz','Barcelona','Burgos','Cáceres',
            'Cádiz','Cantabria','Castellón','Ciudad Real','Córdoba','La Coruña','Cuenca','Gerona','Granada','Guadalajara',
            'Guipúzcoa','Huelva','Huesca','Islas Baleares','Jaén','León','Lérida','Lugo','Madrid','Málaga','Murcia','Navarra',
            'Orense','Palencia','Las Palmas','Pontevedra','La Rioja','Salamanca','Segovia','Sevilla','Soria','Tarragona',
            'Santa Cruz de Tenerife','Teruel','Toledo','Valencia','Valladolid','Vizcaya','Zamora','Zaragoza','Ceuta',
            'Melilla','Lisboa','Leiria','Santarém','Setúbal','Beja','Faro','Ávora','Portalegre','Castelo Branco',
            'Guarda','Coimbra','Aveiro','Viseu','Braganza','Vila Real','Porto','Braga','Viana do Castelo','Horta (Azores)'];

        $array_comunidades = ["Andalucía", "Aragón", "Islas Canarias", "Cantabria", "Castilla y León", "Castilla-La Mancha",
            "Cataluña", "Ceuta", "Comunidad Valenciana", "Comunidad de Madrid", "Extremadura", "Galicia", "Islas Baleares", "La Rioja",
            "Melilla", "Navarra", "País Vasco", "Principado de Asturias", "Murcia", 'Portugal','Andorra'];

        $form_usuarioAsociado->get('idCliente')->setData($codigo_asociado);
        return $this->render('Backoffice/Asociados/detalle_asociado.html.twig', [
            'asociado'=>$asociado,
            'form' => $form_usuarioAsociado->createView(),
            'form_direcciones'=>$form_direccionesAsociado->createView(),
            'array_provincias' =>json_encode($array_provincias),
            'array_comunidades'=>json_encode($array_comunidades),
            'familias1'=>$familias1,
            'familias2'=>$familias2,
            'direcciones'=>$direcciones
        ]);
    }

    /**
     * @Route("/Admin/asociados/{id_asociado}/edit",name="update_post_asociado", requirements={"id_asociado": "\d+"})
     * @Method({"POST"})
     */
    public function updatePOSTAsociadoAction(Request $request)
    {
        $id_asociado = $request->get('pk');
        $em = $this->getDoctrine()->getManager();
        $asociado = $em->getRepository('BackBundle:Asociados')->find($id_asociado);
        if($asociado) {
            if ($request->get('name') == 'nombre-asociado') {
                $nombre = $request->get('value');
                $asociadoByNombre = $em->getRepository('BackBundle:Asociados')->findBy(array('nombre'=>$nombre));
                if($asociadoByNombre){
                    $response = array("status" => "error", "msg"=>"¡Ya existe un asociado con ese nombre!");
                    return new Response(json_encode($response));
                }else{
                    $asociado->setNombre($nombre);
                }
            }elseif($request->get('name') == 'nif-asociado'){
                $nif = $request->get('value');
                $asociadoByNIF = $em->getRepository('BackBundle:Asociados')->findBy(array('nif'=>$nif));
                if($asociadoByNIF){
                    $response = array("status" => "error", "msg"=>"¡Ya existe un asociado con ese NIF!");
                    return new Response(json_encode($response));
                }else{
                    $asociado->setNif($nif);
                }
            }elseif($request->get('name') == 'domicilio-asociado'){
                $domicilio = $request->get('value');
                $asociado->setDomicilio($domicilio);
            }elseif($request->get('name') == 'codPostal-asociado'){
                $codigo_postal = $request->get('value');
                $asociado->setCodigoPostal($codigo_postal);
            }elseif($request->get('name') == 'comunidad-asociado'){
                $comunidad = $request->get('value');
                $asociado->setComunidadAutonoma($comunidad);
            }elseif($request->get('name') == 'provincia-asociado'){
                $provincia = $request->get('value');
                $asociado->setProvincia($provincia);
            }elseif($request->get('name') == 'pais-asociado'){
                $pais = $request->get('value');
                $asociado->setPais($pais);
            }elseif($request->get('name') == 'contacto-asociado'){
                $nombre_contacto = $request->get('value');
                $asociado->setContacto($nombre_contacto);
            }elseif($request->get('name') == 'telefono-asociado'){
                $telefono = $request->get('value');
                $asociado->setTelefono($telefono);
            }elseif($request->get('name') == 'fax-asociado'){
                $fax = $request->get('value');
                $asociado->setFax($fax);
            }elseif($request->get('name') == 'email-asociado'){
                $email = $request->get('value');
                $asociadoByEmail = $em->getRepository('BackBundle:Asociados')->findBy(array('eMail'=>$email));
                if($asociadoByEmail){
                    $response = array("status" => "error", "msg"=>"¡Ya existe un asociado con ese email de contacto!");
                    return new Response(json_encode($response));
                }else{
                    $asociado->setEMail($email);
                }
            }elseif($request->get('name')=='estado-asociado'){
                $estado = $request->get('value');
                $asociado->setActivo($estado);
            }
            else{
                $response = array("status" => "error", "msg"=>"¡Ha ocurrido un error 1!");
                return new Response(json_encode($response));
            }
            $asociado->setFechaEdicion(new \DateTime('now'));
            $em->persist($asociado);
            $em->flush();
            $response = array("code" => 200, "success" => true);
            return new Response(json_encode($response));
        }else{
            $response = array("status" => "error", "msg"=>"¡Ha ocurrido un error 2!");
            return new Response(json_encode($response));
        }

    }

    /**
     * @Route("/Admin/asociados/{id_asociado}/edit",name="edit_post_asociado", requirements={"id_asociado": "\d+"})
     * @Method({"POST"})
     */
    public function editPOSTAsociadoAction(Request $request,$id_asociado)
    {
        /*$asociado = $this->getDoctrine()
            ->getRepository('BackBundle:Asociados')
            ->find($id_asociado);
        $form = $this->createForm(AsociadosType::class, $asociado);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $asociado->setFechaEdicion(new \DateTime("now"));
                $this->getDoctrine()->getManager()->persist($asociado);
                $this->getDoctrine()->getManager()->flush();
                $status = '¡Asociado actualizado correctamente!';
            } else {
                $status = '¡Ha ocurrido un error! ¡Formulario invalido!';
            }
        } else {
            $status = '¡Ha ocurrido un error! ¡Formulario no enviado!';
        }
        $this->user_session->getFlashBag()
            ->add('status', $status);
        return $this->render('Backoffice/Asociados/detalle_asociado.html.twig', [
            'asociado'=>$asociado
        ]);*/
    }

    /**
     * @Route("/Admin/upload_image",options = { "expose" = true }, name="upload_image_asociado")
     * @Method({"POST"})
     */
    public function uploadImageAsociado(Request $request)
    {
        $id_asociado = $request->query->get('id');
        $asociado = $this->getDoctrine()
            ->getRepository('BackBundle:Asociados')
            ->find($id_asociado);
        if($asociado!=null){
            $file = $request->files;
            $file = $file->get('kartik-input-705')[0];
            $ext = $file->guessExtension();
            if(!empty($file) && $file != null) {
                $file_name = $id_asociado.'.'.'jpg';
                $file->move('img/Back/logos/',$file_name);
                $asociado->setLogotipo(1);
                $this->getDoctrine()->getManager()->persist($asociado);
                $this->getDoctrine()->getManager()->flush();
            }
            echo json_encode(['msg'=>'¡Success!']);

        }else{
            echo json_encode(['msg'=>'¡Ha ocurrido un erro!']);
        }
        return new Response();
    }

    /**
     * @Route("/Admin/Asociado/updateFromCsv", name="update_asociado_csv",
     *     options = { "expose" = true })
     * @Method({"POST"})
     */
    public function updateAsociadoFromCSVAction(Request $request){

        $file = $request->files;
        $file = $file->get('asociados')[0];
        $fecha =  date_timestamp_get(date_create());
        if(!empty($file) && $file != null) {
            $file_name =  $fecha.'.csv';
            $file->move('ficheroCSV/Asociados/',$file_name);

            $reader = $this->get('app.file_reader');
            $reader->updateAsociadosFromCsv($file_name);
            echo json_encode(['msg'=>'¡Success!']);
        }else{
            echo json_encode(['msg'=>'¡Ha ocurrido un error!']);
        }
        return new Response();
    }
}
    ############# LEER CSV direcciones ##################
//    public function leerAsociadosAction(){
//
//        $file = new \SplFileObject('../web/ficheroCSV/direcciones.csv');
//        $reader = new CsvReader($file, ';');
//        $reader->setHeaderRowNumber(0);
//        foreach ($reader as $row) {
//            $codigo_asociado = $row['CODIGO'];
//            $asociado = $this->getDoctrine()
//                ->getRepository('BackBundle:Asociados')
//                ->findBy(array('codigoAsociado'=>$codigo_asociado));
//            if($asociado){
//                $direccion = new DireccionesAsociados();
//                $direccion->setIdasociado($asociado[0]);
//                $direccion->setDomicilio(utf8_encode(trim($row['DOMICILIO'])));
//                $direccion->setCodigoPostal($row['CODIGO POSTAL']);
//                $direccion->setPoblacion(utf8_encode(trim($row['POBLACION'])));
//                $direccion->setProvincia(utf8_encode(trim($row['PROVINCIA'])));
//                $direccion->setComunidadAutonoma(utf8_encode(trim($row['COMUNIDAD AUTONOMA'])));
//                $direccion->setPais(utf8_encode(trim($row['PAIS'])));
//                $direccion->setTelefono($row['TELEFONO']);
//                $direccion->setFax($row['FAX']);
//                $direccion->setOficina($row['OFICINA']);
//                $direccion->setAlmacen($row['ALMACEN']);
//                $direccion->setTienda($row['TIENDA']);
//                $direccion->setPrivado($row['PRIVADO']);
//                $direccion->setObservaciones($row['OBSERVACIONES']);
//                $direccion->setEtiquetas($row['ETIQUETAS']);
//                $direccion->setUpdatedat(new \DateTime('now'));
//                $direccion->setCreatedat(new \DateTime('now'));
//
//                $this->getDoctrine()->getManager()
//                    ->persist($direccion);
//            }else{
//                print_r($row['CODIGO']." " . "<br/>");
//            }
//
//        }
//
//        $this->getDoctrine()->getManager()
//            ->flush();
//        echo "FIN";
//        die;
//    }


############# LEER CSV DESCARGAS ##################

/*$batchSize = 8000;
        $i=1;
        foreach ($reader as $row) {
            var_dump($row['ID_DESCARGA']."<br/>");
            $id_usuario = $row['USUARIO_ID_USUARIO'];
            $id_fichero = $row['FICHERO_ID_FICHERO'];
            if($id_usuario != null && $id_fichero!=null){
                $usuario = $this->getDoctrine()
                    ->getRepository('BackBundle:UsuarioAsociado')
                    ->find($id_usuario);

                $fichero = $this->getDoctrine()
                    ->getRepository('BackBundle:Fichero')
                    ->find($id_fichero);
                if($usuario && $fichero){
                    $descarga = new Descarga();

                    $descarga->setFicheroFichero($fichero);
                    $descarga->setUsuarioUsuario($usuario);
                    $descarga->setFecha(new \DateTime($row['FECHA']));

                    $this->getDoctrine()->getManager()->persist($descarga);

                    if (($i % $batchSize) == 0) {
                        $this->getDoctrine()->getManager()->flush();
                        $this->getDoctrine()->getManager()->clear();
                    }
                }else{
                    echo "NO ENTRA";
                }
            }else{
                echo "NO ENTRA";
            }
            $usuario = null;
            $fichero = null;
            $i++;
        }
        $this->getDoctrine()->getManager()->flush();
        $this->getDoctrine()->getManager()->clear();*/

