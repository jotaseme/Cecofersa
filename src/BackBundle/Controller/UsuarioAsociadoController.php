<?php

namespace BackBundle\Controller;

use BackBundle\Entity\UsuarioAsociado;
use BackBundle\Form\UsuarioAsociadoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;

class UsuarioAsociadoController extends Controller
{

    private $user_session;

    public function __construct()
    {
        $this->user_session = new Session();
    }

    /**
     *
     * @Route("/Admin/asociados/{id_asociado}/{id_usuario}/edit", name="update_usuario_asociado")
     * @Method({"POST"})
     */
    public function updateUsuarioAsociadoAction(Request $request)
    {
        $id_usuario = $request->get('pk');
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('BackBundle:UsuarioAsociado')->find($id_usuario);
        if($usuario){
            if($request->get('name')=='email'){
                // Comprobar que ese correo no esta dado de alta ya en la base de datos
                $email = $request->get('value');
                $usuarioByEmail = $em->getRepository('BackBundle:UsuarioAsociado')->findBy(array('eMail'=>$email));
                if($usuarioByEmail){
                    $response = array("status" => "error", "msg"=>"¡Ya existe un usuario con ese email!");
                    return new Response(json_encode($response));
                }else{
                    $usuario->setEMail($email);

                }
            }elseif($request->get('name')=='login'){
                $login = $request->get('value');
                $usuarioByLogin = $em->getRepository('BackBundle:UsuarioAsociado')->findBy(array('login'=>$login));
                if($usuarioByLogin){
                    $response = array("status" => "error", "msg"=>"¡Ya existe un usuario con ese login!");
                    return new Response(json_encode($response));
                }else{
                    $usuario->setLogin(strtoupper($login));
                }
            }elseif($request->get('name')=='estadoBloqueo'){
                $estado_bloqueo = $request->get('value');
                $usuario->setEstadoBloqueo($estado_bloqueo);
            }
            elseif($request->get('name')=='areaPrivada'){
                $accesoPrivada = $request->get('value');
                $usuario->setAccWebPrivada($accesoPrivada);
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
            $usuario->setUpdatedAt(new \DateTime('now'));
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
     * @Route("/Admin/asociados/{id_asociado}/usuario/create", name="create_usuario_asociado",
     *     options = { "expose" = true },
     *  )
     * @Method({"POST"})
     */
    public function createUsuarioAction(Request $request, $id_asociado)
    {
        $usuario = new UsuarioAsociado();
        $form = $this->createForm(UsuarioAsociadoType::class, $usuario);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            if ($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $asociado = $em->getRepository('BackBundle:Asociados')->find($id_asociado);
                $usuarioByEmail = $em->getRepository('BackBundle:UsuarioAsociado')->findBy(array('eMail'=>$usuario->getEMail()));
                $usuarioByLogin = $em->getRepository('BackBundle:UsuarioAsociado')->findBy(array('login'=>$usuario->getLogin()));
                if($usuarioByEmail){
                    $status = '¡Ya existe un usuario con ese email!';
                    $this->user_session->getFlashBag()
                        ->add('status', $status);
                    return $this->redirect("/Admin/asociados/$id_asociado");
                }
                if($usuarioByLogin){
                    $status = '¡Ya existe un usuario con ese Login!';
                    $this->user_session->getFlashBag()
                        ->add('status', $status);
                    return $this->redirect("/Admin/asociados/$id_asociado");
                }
                if(!isset($asociado)){
                    $status = '¡Ha ocurrido un error!';
                }else{
                    $usuario->setIdCliente($asociado->getCodigoAsociado());
                    $usuario->setEstadoBloqueo('Normal');
                    $usuario->setCreatedAt(new \DateTime('now'));
                    $usuario->setIdAsociado($asociado);
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

        return $this->redirect("/Admin/asociados/$id_asociado");
    }


    /**
     * @Route("/Admin/asociados/{id_asociado}/{id_usuario}/delete", name="delete_usuario_asociado",
     *     options = { "expose" = true },
     *  )
     * @Method({"POST"})
     */
    public function deleteUsuarioAction(Request $request)
    {
        $id_usuario = $request->get('id_usuario');
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('BackBundle:UsuarioAsociado')->find($id_usuario);
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

    /**
     * @Route("/Admin/asociados/{id_asociado}/usuarios/{id_usuario}", name="show_usuario_asociado")
     * @Method({"get"})
     */
    public function showUsuarioAction($id_asociado,$id_usuario, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('BackBundle:UsuarioAsociado')->find($id_usuario);
        if(!isset($usuario)){
            return $this->redirect("/Admin/asociados/$id_asociado");
        }
        $descargas_dia = $em->getRepository('BackBundle:Descarga')->findDownloadsLast24H($id_usuario);
        $descargas_semana = $em->getRepository('BackBundle:Descarga')->findDownloadsLast7D($id_usuario);
        $descargas_mes = $em->getRepository('BackBundle:Descarga')->findDownloadsLast30D($id_usuario);

        $años = $em->getRepository('BackBundle:Descarga')->findDownloadYears($id_usuario);
        if(sizeof($años)>3){
            $años = array_slice($años, -3);
        }

        $date=new \DateTime();

        $this->actYear = $date->format('Y');
        $current_year = $this->actYear;
        $serie = array();
        for($a=$años[0][1];$a<=$current_year;$a++)
        {
            $array=array();
            for($i=1;$i<=12;$i++)
            {
                $contador = (int)$this->getDoctrine()
                    ->getRepository('BackBundle:Descarga')
                    ->count_downloads($i,$a,$id_usuario);
                array_push($array,[strtotime('01-'.$i.'-2014') * 1000, $contador]);
            }
            $serie_aux = array(
                'name'=>"Descargas ".$a,
                'data'=>$array
            );
            array_push($serie,$serie_aux);
        }

        if($descargas_dia==0){
            $porcentaje_dia = 0;
        }else{
            $porcentaje_dia = 100*$descargas_dia/30;
        }

        if($descargas_semana==0){
            $porcentaje_semana = 0;
        }else{
            $porcentaje_semana = 100*$descargas_semana/70;
        }

        if($descargas_mes==0){
            $porcentaje_mes = 0;
        }else{
            $porcentaje_mes = $descargas_mes;
        }


        $descargas = $this->getDoctrine()
            ->getRepository('BackBundle:Descarga')
            ->findAllOrderedByDate($id_usuario);

        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT d FROM BackBundle:Descarga d WHERE d.usuarioUsuario = :id_usuario ORDER BY d.fecha DESC";
        $query = $em->createQuery($dql)->setParameter('id_usuario',$id_usuario);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        if(empty(!$descargas)){
            $historico = true;
            $last_element = end($descargas)->getFecha()->format('Y');
        }else $historico = false;

        $contador_anual = array();
        if($historico)
        {
            for($i=$last_element;$i<=$current_year;$i++)
            {
                $contador_aux = (int)$this->getDoctrine()
                    ->getRepository('BackBundle:Descarga')
                    ->count_downloads_history($i,$id_usuario);
                if(!$contador_aux){

                }else{

                    $anual = array(
                        (string)$i,
                        $contador_aux
                    );
                    array_push($contador_anual,$anual);
                }
            }
        }
        $contador_anual = json_encode($contador_anual);



        return $this->render('Backoffice/Asociados/detalle_usuario_asociado.html.twig', [
            'usuario'=>$usuario,
            'dia'=>$descargas_dia,
            'semana'=>$descargas_semana,
            'mes'=>$descargas_mes,
            'porcentaje_dia'=>$porcentaje_dia,
            'porcentaje_semana'=>$porcentaje_semana,
            'porcentaje_mes'=>$porcentaje_mes,
            'historico_descargas'=>$serie,
            'historico_anual'=>$contador_anual,
            'pagination' => $pagination
        ]);
    }






































    /**
     * @Route("/", name="homepage")
     */
    /*public function indexAction()
    {
        $count_asociados = $this->getDoctrine()
            ->getRepository('AppBundle:Asociados')
            ->count();




        $date=new \DateTime();

        $this->actYear = $date->format('Y');
        $current_year = $this->actYear;

        $serie = array();
        for($a=2012;$a<=$current_year;$a++)
        {
            $array=array();

            for($i=1;$i<=12;$i++)
            {
                $contador = (int)$this->getDoctrine()
                    ->getRepository('AppBundle:Descarga')
                    ->count_downloads($i,$a);
                array_push($array,[strtotime('02-'.$i.'-2014') * 1000, $contador]);
            }


            $serie_aux = array(
                'name'=>"Descargas ".$a,
                'data'=>$array
            );
            array_push($serie,$serie_aux);

            //print_r(json_encode($serie));
            //die();
        }
        return $this->render('default/home.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'count_asociados'=>$count_asociados,
            'count_proveedores'=>$count_proveedores,
            'count_ficheros'=>$count_ficheros,
            'series_historico'=>$serie
        ]);
    }

    public function count_downloads($month,$year)
    {

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('COUNT(d.idDescarga)')
            ->from('AppBundle:Descarga', 'd')
            ->where('YEAR(d.fecha) = :year')
            ->andWhere('MONTH(d.fecha) = :current_month')

            ->setParameter('year', $year)
            ->setParameter('current_month', $month);
        try{
            $result = $qb->getQuery()->getSingleScalarResult();
        }catch (\Doctrine\ORM\NoResultException $e){
            return false;
        }

        return $result;
    }*/



}
