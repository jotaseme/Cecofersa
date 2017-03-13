<?php

namespace BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AsociadosType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre')->add('domicilio')->add('poblacion')->add('codigoPostal')->add('provincia')->add('contacto')->add('telefono')->add('fax')->add('eMail')->add('numEmpleados')->add('numVendedores')->add('zonaInfluencia')->add('superficieTienda')->add('otrasEspec')->add('codigoAsociado')->add('soloPedirCitas')->add('logotipo')->add('supAlmacen')->add('pagWeb')->add('comunidadAutonoma')->add('nif')->add('pais')->add('accFeria')->add('activoFeria')->add('activo')->add('fechaAlta')->add('fechaBaja');
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
