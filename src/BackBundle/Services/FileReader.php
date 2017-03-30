<?php

namespace BackBundle\Services;

use BackBundle\Entity\Asociados;
use BackBundle\Entity\Familias;
use BackBundle\Entity\FamiliasAsociados;
use BackBundle\Entity\Proveedores;
use Doctrine\ORM\EntityManager;
use Ddeboer\DataImport\Reader\CsvReader;
use Symfony\Component\Validator\Constraints\DateTime;

ini_set('memory_limit', '512M');
ini_set('max_execution_time', 9200);

class FileReader
{
    protected $em;
    protected $csv_reader;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    function updateProveedoresFromCsv($fichero){
        $file = new \SplFileObject("../web/ficheroCSV/Proveedores/$fichero");
        $reader = new CsvReader($file,";");
        $reader->setHeaderRowNumber(0);
        foreach ($reader as $id => $row) {
            $nif_proveedor = $row['CIF'];
            $proveedor = $this->em->getRepository('BackBundle:Proveedores')
                ->findBy(array('nif'=>$nif_proveedor));
            if($proveedor){
                $proveedor = $proveedor[0];
                $proveedor->setProveedor(utf8_encode(trim($row['PROVEEDOR'])));
                $proveedor->setNombreComercial(utf8_encode(trim($row['NOMBRE COMERCIAL'])));
                $proveedor->setGestor(trim($row['DIVISION']));
                $proveedor->setDireccion(utf8_encode(trim($row['DIRECCION'])));
                $proveedor->setPoblacion(utf8_encode(trim($row['POBLACION'])));
                $proveedor->setProvincia(utf8_encode(trim($row['PROVINCIA'])));
                $proveedor->setCodigoPostal(trim($row['CODIGO POSTAL']));
                $proveedor->setNif(trim($row['CIF']));
                $proveedor->setTelefono(trim($row['TELEFONO']));
                $proveedor->setFax(trim($row['FAX']));
                $proveedor->setResponsableConvenio(utf8_encode(trim($row['RESPONSABLE CONVENIO'])));
                $proveedor->setCargoConvenio(utf8_encode(trim($row['CARGO CONVENIO'])));
                $proveedor->setEmailConvenio(trim($row['E-MAIL CONVENIO']));
                $proveedor->setConvenioColaboracion(trim($row['CONVENIO COLABORACION']));

                if($row['FECHA CONVENIO']==null){
                    $fecha_convenio = null;
                }else{
                    $fecha_convenio = \DateTime::createFromFormat('d/m/Y', $row['FECHA CONVENIO']);
                }
                $proveedor->setFechaConvenio($fecha_convenio);
                $proveedor->setVigencia(($row['VIGENCIA']));
                $proveedor->setPrecios(utf8_encode(($row['PRECIOS'])));
                $proveedor->setIva(utf8_encode(($row['IVA'])));
                $proveedor->setDescuentosFactura(utf8_encode(($row['DTOS FACTURA'])));
                $proveedor->setGestionCentralizada(utf8_encode(($row['GESTION CENTRALIZADA'])));
                $proveedor->setPortesPeninsula(utf8_encode(($row['PORTES'])));
                $proveedor->setFormaPago(utf8_encode(($row['FORMA DE PAGO'])));
                $proveedor->setProntoPago(utf8_encode(($row['PRONTO PAGO'])));
                $proveedor->setAndorra(utf8_encode(($row['ANDORRA'])));
                $proveedor->setGibraltar(utf8_encode(($row['GIBRALTAR'])));
                $proveedor->setPortugal(utf8_encode(($row['PORTUGAL'])));
                $proveedor->setCanarias(utf8_encode(($row['CANARIAS'])));
                $proveedor->setBaleares(utf8_encode(($row['BALEARES'])));
                $proveedor->setCeutaMelilla(utf8_encode(($row['CEUTA Y MELILLA'])));
                $proveedor->setArticulosComercializa(utf8_encode(($row['ARTICULOS QUE COMERCIALIZA'])));
                $proveedor->setArticulosProveedor(utf8_encode(($row['ARTICULOS PROVEEDOR'])));
                $proveedor->setRappelCecofersa(utf8_encode(($row['RAPPEL CECOFERSA'])));
                $proveedor->setRappelAsociado(utf8_encode(($row['RAPPEL ASOCIADO'])));
                $proveedor->setObservaciones(utf8_encode(($row['OBSERVACIONES'])));
                $proveedor->setParticipacionCatalogo(($row['PARTICIPACION EN ULTIMO CATALOGO']));
                $proveedor->setPaginaWeb(($row['PAGINA WEB']));
                $proveedor->setValidezEspa(($row['VALIDEZ ESPA']));
                $proveedor->setValidezPortugal(($row['VALIDEZ PORTUGAL']));
                $proveedor->setPedidoMinimo(($row['PEDIDO MINIMO']));
                $proveedor->setMarcas(utf8_encode(($row['MARCAS'])));
                $proveedor->setFamilia(($row['GRUPO DE TRABAJO']));
                $proveedor->setExpocecofersa(($row['EXPOCECOFERSA']));
                $proveedor->setPublicidad((utf8_encode($row['PUBLICIDAD'])));
                $proveedor->setLogotipo(0);
                if($row['FECHA ALTA']==null){
                    $fecha_alta = null;
                }else{
                    $fecha_alta =  \DateTime::createFromFormat('d/m/Y', $row['FECHA ALTA']);
                }
                if($row['FECHA BAJA']==null){
                    $fecha_baja = null;
                }else{
                    $fecha_baja =  \DateTime::createFromFormat('d/m/Y', $row['FECHA BAJA']);
                }
                $proveedor->setFechaAlta($fecha_alta);
                $proveedor->setFechaBaja($fecha_baja);
                $proveedor->setFechaEdicion(new \DateTime('now'));

                $this->em->persist($proveedor);
            }else{
                $proveedor = new Proveedores();
                $proveedor->setProveedor(utf8_encode($row['PROVEEDOR']));
                $proveedor->setNombreComercial(utf8_encode(($row['NOMBRE COMERCIAL'])));
                $proveedor->setGestor(($row['DIVISION']));
                $proveedor->setDireccion(utf8_encode(($row['DIRECCION'])));
                $proveedor->setPoblacion(utf8_encode(($row['POBLACION'])));
                $proveedor->setProvincia(utf8_encode(($row['PROVINCIA'])));
                $proveedor->setCodigoPostal(($row['CODIGO POSTAL']));
                $proveedor->setNif(($row['CIF']));
                $proveedor->setTelefono(($row['TELEFONO']));
                $proveedor->setFax(($row['FAX']));
                $proveedor->setResponsableConvenio(utf8_encode(($row['RESPONSABLE CONVENIO'])));
                $proveedor->setCargoConvenio(utf8_encode(($row['CARGO CONVENIO'])));
                $proveedor->setEmailConvenio(($row['E-MAIL CONVENIO']));
                $proveedor->setConvenioColaboracion(($row['CONVENIO COLABORACION']));
                if($row['FECHA CONVENIO']==null){
                    $fecha_convenio = null;
                }else{

                    $fecha_convenio = \DateTime::createFromFormat('d/m/Y', $row['FECHA CONVENIO']);
                }
                $proveedor->setFechaConvenio($fecha_convenio);
                $proveedor->setVigencia(($row['VIGENCIA']));
                $proveedor->setPrecios(utf8_encode(($row['PRECIOS'])));
                $proveedor->setIva(utf8_encode(($row['IVA'])));
                $proveedor->setDescuentosFactura(utf8_encode(($row['DTOS FACTURA'])));
                $proveedor->setGestionCentralizada(utf8_encode(($row['GESTION CENTRALIZADA'])));
                $proveedor->setPortesPeninsula(utf8_encode(($row['PORTES'])));
                $proveedor->setFormaPago(utf8_encode(($row['FORMA DE PAGO'])));
                $proveedor->setProntoPago(utf8_encode(($row['PRONTO PAGO'])));
                $proveedor->setAndorra(utf8_encode(($row['ANDORRA'])));
                $proveedor->setGibraltar(utf8_encode(($row['GIBRALTAR'])));
                $proveedor->setPortugal(utf8_encode(($row['PORTUGAL'])));
                $proveedor->setCanarias(utf8_encode(($row['CANARIAS'])));
                $proveedor->setBaleares(utf8_encode(($row['BALEARES'])));
                $proveedor->setCeutaMelilla(utf8_encode(($row['CEUTA Y MELILLA'])));
                $proveedor->setArticulosComercializa(utf8_encode(($row['ARTICULOS QUE COMERCIALIZA'])));
                $proveedor->setArticulosProveedor(utf8_encode(($row['ARTICULOS PROVEEDOR'])));
                $proveedor->setRappelCecofersa(utf8_encode(($row['RAPPEL CECOFERSA'])));
                $proveedor->setRappelAsociado(utf8_encode(($row['RAPPEL ASOCIADO'])));
                $proveedor->setObservaciones(utf8_encode(($row['OBSERVACIONES'])));
                $proveedor->setParticipacionCatalogo(($row['PARTICIPACION EN ULTIMO CATALOGO']));
                $proveedor->setPaginaWeb(($row['PAGINA WEB']));
                $proveedor->setValidezEspa(($row['VALIDEZ ESPA']));
                $proveedor->setValidezPortugal(($row['VALIDEZ PORTUGAL']));
                $proveedor->setPedidoMinimo(($row['PEDIDO MINIMO']));
                $proveedor->setMarcas(utf8_encode(($row['MARCAS'])));
                $proveedor->setFamilia(($row['GRUPO DE TRABAJO']));
                $proveedor->setExpocecofersa(($row['EXPOCECOFERSA']));
                $proveedor->setPublicidad(utf8_encode(($row['PUBLICIDAD'])));
                $proveedor->setLogotipo(0);
                if($row['FECHA ALTA']==null){
                    $fecha_alta = null;
                }else{
                    $fecha_alta = \DateTime::createFromFormat('d/m/Y', $row['FECHA ALTA']);
                }
                if($row['FECHA BAJA']==null){
                    $fecha_baja = null;
                }else{
                    $fecha_baja = \DateTime::createFromFormat('d/m/Y', $row['FECHA BAJA']);
                }
                $proveedor->setFechaAlta($fecha_alta);
                $proveedor->setFechaBaja($fecha_baja);
                $proveedor->setFechaEdicion(new \DateTime('now'));
                $this->em->persist($proveedor);
            }
        }
        $this->em->flush();
        return true;
    }

    function updateAsociadosFromCsv($fichero){
        $file = new \SplFileObject("../web/ficheroCSV/Asociados/$fichero");
        $reader = new CsvReader($file, ';');
        $reader->setHeaderRowNumber(0);
        foreach ($reader as $id => $row) {
            $codigo_asociado = substr($row['CODIGO'], 0, strpos($row['CODIGO'], ','));
            $asociado = $this->em->getRepository('BackBundle:Asociados')
                ->findBy(array('codigoAsociado'=>$codigo_asociado));
            if($asociado){
                $asociado = $asociado[0];
                $asociado->setNombre(utf8_encode(trim($row['NOMBRE CLIENTE'])));
                $asociado->setNif(trim($row['NIF']));
                $asociado->setDomicilio(utf8_encode(trim($row['DOMICILIO'])));
                $asociado->setCodigoPostal(trim($row['CODIGO POSTAL']));
                $asociado->setPoblacion(utf8_encode(trim($row['POBLACION'])));
                $asociado->setProvincia(utf8_encode(trim($row['PROVINCIA'])));
                $asociado->setComunidadAutonoma(utf8_encode(trim($row['COMUNIDAD AUTONOMA'])));
                $asociado->setContacto(utf8_encode(trim($row['PERSONA CONTACTO'])));
                $asociado->setTelefono(trim($row['TELEFONO']));
                $asociado->setFax(trim($row['FAX']));
                $asociado->setPagWeb(trim($row['PAG WEB']));
                $asociado->setNumEmpleados(trim($row['NUM EMPLEADOS']));
                $asociado->setNumVendedores(trim($row['NUM VENDEDORES']));
                $asociado->setZonaInfluencia(trim($row['ZONA INFLUENCIA']));
                $asociado->setSuperficieTienda(trim($row['SUP TIENDA']));
                $asociado->setSupAlmacen(trim($row['SUP ALMACEN']));
                $asociado->setPais(trim($row['PAIS_ORIGEN']));
                $asociado->setFechaEdicion(new \DateTime('now'));

                $this->em->persist($asociado);

            }else{
                $asociado = new Asociados();
                $asociado->setCodigoAsociado($codigo_asociado);
                $asociado->setNombre(utf8_encode(trim($row['NOMBRE CLIENTE'])));
                $asociado->setNif(trim($row['NIF']));
                $asociado->setDomicilio(utf8_encode(trim($row['DOMICILIO'])));
                $asociado->setCodigoPostal(trim($row['CODIGO POSTAL']));
                $asociado->setPoblacion(utf8_encode(trim($row['POBLACION'])));
                $asociado->setProvincia(utf8_encode(trim($row['PROVINCIA'])));
                $asociado->setComunidadAutonoma(utf8_encode(trim($row['COMUNIDAD AUTONOMA'])));
                $asociado->setContacto(utf8_encode(trim($row['PERSONA CONTACTO'])));
                $asociado->setTelefono(trim($row['TELEFONO']));
                $asociado->setFax(trim($row['FAX']));
                $asociado->setPagWeb(trim($row['PAG WEB']));
                $asociado->setNumEmpleados(trim($row['NUM EMPLEADOS']));
                $asociado->setNumVendedores(trim($row['NUM VENDEDORES']));
                $asociado->setZonaInfluencia(trim($row['ZONA INFLUENCIA']));
                $asociado->setSuperficieTienda(trim($row['SUP TIENDA']));
                $asociado->setSupAlmacen(trim($row['SUP ALMACEN']));
                $asociado->setPais(trim($row['PAIS_ORIGEN']));
                $asociado->setFechaEdicion(new \DateTime('now'));

                $this->em->persist($asociado);
            }
            $this->em->flush();

        }
        return true;
    }

    function updateFamilias($fichero){

        $file = new \SplFileObject("../web/ficheroCSV/Familias/$fichero");
        $reader = new CsvReader($file, ';');
        $reader->setHeaderRowNumber(0);

        foreach ($reader as $id => $row) {
            $familia = $this->em->getRepository('BackBundle:Familias')
                ->findBy(array('nombreFamilia'=>utf8_encode($row['FAMILIA'])));
            if(!$familia){
                $familia = new Familias();
                $familia->setNombreFamilia(utf8_encode($row['FAMILIA']));
                $this->em->persist($familia);
                $this->em->flush();
            }
            $codigo_asociado = substr($row['CODIGO'], 0, strpos($row['CODIGO'], ','));
            $asociado = $this->em->getRepository('BackBundle:Asociados')
                ->findBy(array('codigoAsociado'=>$codigo_asociado));
            if($asociado){
                $familia_asociado =  $this->em->getRepository('BackBundle:FamiliasAsociados')
                    ->findBy(array(
                        'idAsociado'=>$asociado[0]->getIdAsociado(),
                        'idFamilia'=>$familia[0]->getIdFamilias()
                    ));
                if($familia_asociado){
                    $familia_asociado = $familia_asociado[0];
                    $familia_asociado->setVolumen($row['VOLUMEN']);
                    $this->em->persist($familia_asociado);
                }else{
                    $familia_asociado = new FamiliasAsociados();
                    $familia_asociado->setIdFamilia($familia[0]);
                    $familia_asociado->setIdAsociado($asociado[0]);
                    $familia_asociado->setVolumen($row['VOLUMEN']);
                    $familia_asociado->setNombreFamilia($familia[0]->getNombreFamilia());
                    $this->em->persist($familia_asociado);
                }
            }
        }
        $this->em->flush();
        return true;

    }
}