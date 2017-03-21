<?php

namespace BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Date;

class AsociadosType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array(
                'label'=> 'Nombre',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                )
            ))
            ->add('domicilio', TextType::class, array(
                'label'=> 'Direccion',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                )
            ))
            ->add('poblacion', TextType::class, array(
                'label'=> 'Población',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                )
            ))
            ->add('codigoPostal', TextType::class, array(
                'label'=> 'Código postal',
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
            ->add('contacto', TextType::class, array(
                'label'=> 'Contacto',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                )
            ))
            ->add('telefono', TextType::class, array(
                'label'=> 'Teléfono',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                )
            ))
            ->add('fax',TextType::class, array(
                'label'=> 'Fax',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                )
            ))
            ->add('eMail', EmailType::class, array(
                'label'=> 'Email',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                )
            ))
            ->add('comunidadAutonoma', TextType::class, array(
                'label'=> 'Comunidad autónoma',
                'required'=>false,
                'attr'=> array(
                    'class'=> 'form-name form-control'
                )
            ))
            ->add('nif', TextType::class, array(
                'label'=> 'NIF',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                )
            ))
            ->add('pais', ChoiceType::class, array(
                'label'=> 'Pais',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                ),
                'choices' => array('España' => 'ES',
                    'Portugal' =>'PT')
            ))
            ->add('activo', ChoiceType::class, array(
                'label'=> 'Activo',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                ),
                'choices' => array('Activo' => '1',
                    'Inactivo' =>'0')
            ))

            ->add('fechaAlta', DateType::class, array(
                'label'=> 'Fecha de alta',
                'attr'=> array(
                    'class'=> 'form-date form-control'
                )

            ))
            ->add('fechaBaja', DateType::class, array(
                'label'=> 'Fecha de baja',
                'attr'=> array(
                    'class'=> 'form-date form-control'
                )

            ))
            ->add('Actualizar asociado',SubmitType::class, array(
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
            'data_class' => 'BackBundle\Entity\Asociados'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backbundle_asociados';
    }


}
