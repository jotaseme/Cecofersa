<?php

namespace BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DireccionesAsociadosType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('domicilio', TextType::class, array(
                'label'=> 'Domicilio',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control',
                )
            ))
            ->add('codigoPostal', TextType::class, array(
                'label'=> 'Codigo postal',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                )
            ))
            ->add('poblacion', TextType::class, array(
                'label'=> 'Poblacion',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                )
            ))
            ->add('provincia', ChoiceType::class, array(
                'label'=> 'Provincia',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                ),
                'choices' => array(
                    "Álava"=>"Álava",
                    "Albacete"=>"Albacete",
                    "Alicante"=>"Alicante",
                    "Almería"=>"Almería",
                    "Andorra"=>"Andorra",
                    "Asturias"=>"Asturias",
                    "Aveiro"=>"Aveiro",
                    "Ávila"=>"Ávila",
                    "Azores"=>"Azores",
                    "Badajoz"=>"Badajoz",
                    "Baleares"=>"Baleares",
                    "Barcelona"=>"Barcelona",
                    "Beja"=>"Beja",
                    "Braga"=>"Braga",
                    "Braganza"=>"Braganza",
                    "Burgos"=>"Burgos",
                    "Cáceres"=>"Cáceres",
                    "Cádiz"=>"Cádiz",
                    "Cantabria"=>"Cantabria",
                    "Castellón"=>"Castellón",
                    "Castelo Branco"=>"Castelo Branco",
                    "Ceuta"=>"Ceuta",
                    "Ciudad Real"=>"Ciudad Real",
                    "Coimbra"=>"Coimbra",
                    "Córdoba"=>"Córdoba",
                    "Cuenca"=>"Cuenca",
                    "Ávora"=>"Ávora",
                    "Faro"=>"Faro",
                    "Gerona"=>"Gerona",
                    "Gibraltar"=>"Gibraltar",
                    "Granada"=>"Granada",
                    "Guadalajara"=>"Guadalajara",
                    "Guarda"=>"Guarda",
                    "Guipúzcoa"=>"Guipúzcoa",
                    "Huelva"=>"Huelva",
                    "Huesca"=>"Huesca",
                    "Jaén"=>"Jaén",
                    "La Coruña"=>"La Coruña",
                    "La Rioja"=>"La Rioja",
                    "Las Palmas de Gran Canaria"=>"Las Palmas de Gran Canaria",
                    "Leiria"=>"Leiria",
                    "León"=>"León",
                    "Lérida"=>"Lérida",
                    "Lisboa"=>"Lisboa",
                    "Lugo"=>"Lugo",
                    "Madeira"=>"Madeira",
                    "Madrid"=>"Madrid",
                    "Málaga"=>"Málaga",
                    "Melilla"=>"Melilla",
                    "Murcia"=>"Murcia",
                    "Navarra"=>"Navarra",
                    "Oporto"=>"Oporto",
                    "Orense"=>"Orense",
                    "Pontevedra"=>"Pontevedra",
                    "Portalegre"=>"Portalegre",
                    "Portugal"=>"Portugal",
                    "Salamanca"=>"Salamanca",
                    "Santa Cruz de Tenerife"=>"Santa Cruz de Tenerife",
                    "Santarém"=>"Santarém",
                    "Segovia"=>"Segovia",
                    "Setúbal"=>"Setúbal",
                    "Sevilla"=>"Sevilla",
                    "Soria"=>"Soria",
                    "Tarragona"=>"Tarragona",
                    "Teruel"=>"Teruel",
                    "Toledo"=>"Toledo",
                    "Valencia"=>"Valencia",
                    "Valladolid"=>"Valladolid",
                    "Viana do Castelo"=>"Viana do Castelo",
                    "Vila Real"=>"Vila Real",
                    "Viseu"=>"Viseu",
                    "Vizcaya"=>"Vizcaya",
                    "Zamora"=>"Zamora",
                    "Zaragoza"=>"Zaragoza"
                )
            ))
            ->add('comunidadAutonoma', ChoiceType::class, array(
                'label'=> 'Comunidad autonoma',
                'required'=>false,
                'attr'=> array(
                    'class'=> 'form-name form-control'
                ),
                'choices' => array(
                    "Andalucía"=> "Andalucía",
                    "Aragón" => "Aragón" ,
                    "Islas Canarias"=> "Islas Canarias",
                    "Cantabria"=> "Cantabria",
                    "Castilla y León"=> "Castilla y León",
                    "Castilla-La Mancha"=> "Castilla-La Mancha",
                    "Cataluña"=> "Cataluña",
                    "Ceuta"=> "Ceuta",
                    "Comunidad Valenciana"=> "Comunidad Valenciana",
                    "Comunidad de Madrid"=> "Comunidad de Madrid",
                    "Extremadura"=>"Extremadura",
                    "Galicia"=> "Galicia",
                    "Islas Baleares"=> "Islas Baleares",
                    "La Rioja"=> "La Rioja",
                    "Melilla"=> "Melilla",
                    "Navarra"=> "Navarra",
                    "País Vasco"=> "País Vasco",
                    "Principado de Asturias"=> "Principado de Asturias",
                    "Murcia"=> "Murcia",
                    'Portugal'=> 'Portugal',
                    'Andorra'=>'Andorra'
                )
            ))
            ->add('pais', ChoiceType::class, array(
                'label'=> 'Pais',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                ),
                'choices' => array('España' => 'ESPAÑA',
                    'Portugal' =>'PORTUGAL')
            ))
            ->add('telefono', TextType::class, array(
                'label'=> 'Teléfono',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                )
            ))
            ->add('fax', TextType::class, array(
                'label'=> 'Fax',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                )
            ))
            ->add('oficina', ChoiceType::class, array(
                'label'=> 'Dirección de oficina',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                ),
                'choices' => array('Activo' => 'VERDADERO',
                    'Inactivo' =>'FALSO')
            ))
            ->add('almacen', ChoiceType::class, array(
                'label'=> 'Dirección de almacén',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                ),
                'choices' => array('Activo' => 'VERDADERO',
                    'Inactivo' =>'FALSO')
            ))
            ->add('tienda', ChoiceType::class, array(
                'label'=> 'Dirección de tienda',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                ),
                'choices' => array('Activo' => 'VERDADERO',
                    'Inactivo' =>'FALSO')
            ))
            ->add('privado', ChoiceType::class, array(
                'label'=> 'Dirección privada',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                ),
                'choices' => array('Activo' => 'VERDADERO',
                    'Inactivo' =>'FALSO')
            ))
            ->add('observaciones', TextType::class, array(
                'label'=> 'Observaciones',
                'required'=>false,
                'attr'=> array(
                    'class'=> 'form-name form-control'
                )
            ))
            ->add('etiquetas', ChoiceType::class, array(
                'label'=> 'Dirección a incluir para etiquetas',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                ),
                'choices' => array('Activo' => 'VERDADERO',
                    'Inactivo' =>'FALSO')
            ))
            ->add('Crear direccion',SubmitType::class, array(
                "attr" => array(
                    "class"=>"form-submit btn btn-primary"
                )
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackBundle\Entity\DireccionesAsociados'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backbundle_direccionesasociados';
    }


}
