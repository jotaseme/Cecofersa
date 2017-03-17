<?php

namespace BackBundle\Services;

use BackBundle\Entity\Asociados;
use BackBundle\Entity\Familias;
use BackBundle\Entity\FamiliasAsociados;
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