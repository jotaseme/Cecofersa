<?php

namespace BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UsuarioProveedorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', TextType::class, array(
                'label'=> 'Login',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                )
            ))
            ->add('idProveedor',TextType::class, array(
                'label'=> 'Id Proveedor',
                'required'=>'required',
                'disabled'=>'disabled',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                )
            ))
            ->add('email', EmailType::class, array(
                'label'=> 'Email',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                )
            ))
            ->add('accesoWebExpoVirtual',ChoiceType::class, array(
                'label'=> 'Acceso a ExpoCecofersa Virtual',
                'required'=>'required',
                'attr'=> array(
                    'class'=> 'form-name form-control'
                ),
                'choices' => array('Activo' => '1',
                    'Inactivo' =>'0')
            ))
            ->add('accesoWebExpoReal',ChoiceType::class, array(
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
            'data_class' => 'BackBundle\Entity\UsuarioProveedor'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backbundle_usuarioproveedor';
    }


}
