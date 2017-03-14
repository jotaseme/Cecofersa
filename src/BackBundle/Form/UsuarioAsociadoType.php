<?php

namespace BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UsuarioAsociadoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', TextType::class, array(
                'label'=> 'Nombre',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                )
            ))
            ->add('idCliente',TextType::class, array(
                    'label'=> 'Codigo de asociado',
                    'required'=>'required',
                    'disabled'=>'disabled',
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
            ->add('accWebPrivada',ChoiceType::class, array(
                'label'=> 'Acceso al Area Privada de Cecofersa',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                ),
                'choices' => array('Activo' => '1',
                    'Inactivo' =>'0')
            ))
            ->add('accWebExpoVirtual',ChoiceType::class, array(
                'label'=> 'Acceso a ExpoCecofersa Virtual',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                ),
                'choices' => array('Activo' => '1',
                    'Inactivo' =>'0')
            ))
            ->add('accWebExpoReal',ChoiceType::class, array(
                'label'=> 'Acceso a ExpoCecofersa Feria',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                ),
                'choices' => array('Activo' => '1',
                    'Inactivo' =>'0')
            ))
            ->add('Crear usuario',SubmitType::class, array(
                "attr" => array(
                    "class"=>"form-submit btn btn-primary"
                )
            ));
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackBundle\Entity\UsuarioAsociado'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backbundle_usuarioasociado';
    }


}
