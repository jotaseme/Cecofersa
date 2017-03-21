<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{
    /**
     * @Route("/{languaje}", name="ceco_index")
     */
    public function indexAction($languaje='es', $activo='index')
    {
        return $this->render('Cecofersa/inicio.html.twig',
            ['languaje' => $languaje,
             'activo' => $activo
        ]);

    }

    /**
     * @Route("/{languaje}/somos", name="ceco_somos")
     */
    public function somosAction($languaje='es', $activo='somos')
    {
        return $this->render('Cecofersa/quienes-somos.html.twig',
            ['languaje' => $languaje,
             'activo' => $activo,
            ]);

    }

    /**
     * @Route("/{languaje}/servicios", name="ceco_servicios")
     */
    public function serviciosAction($languaje='es', $activo='servicios')
    {
        return $this->render('Cecofersa/servicios.html.twig',
            ['languaje' => $languaje,
             'activo' => $activo
            ]);

    }

    /**
     * @Route("/{languaje}/folletos", name="ceco_folletos")
     */
    public function folletosAction($languaje='es', $activo='folletos')
    {
        return $this->render('Cecofersa/folletos.html.twig',
            ['languaje' => $languaje,
             'activo' => $activo
            ]);

    }

    /**
     * @Route("/{languaje}/productos", name="ceco_productos")
     */
    public function productosAction($languaje='es', $activo='productos')
    {
        return $this->render('Cecofersa/ceco-productos.html.twig',
            ['languaje' => $languaje,
             'activo' => $activo
            ]);

    }

    /**
     * @Route("/{languaje}/informacion", name="ceco_informacion")
     */
    public function informacionAction($languaje='es', $activo='informacion')
    {
        return $this->render('Cecofersa/ceco-informacion.html.twig',
            ['languaje' => $languaje,
             'activo' => $activo
            ]);

    }

    /**
     * @Route("/{languaje}/asociados", name="ceco_asociados")
     */
    public function asociadosAction($languaje='es', $activo='asociados')
    {
        return $this->render('Cecofersa/ceco-asociados.html.twig',
            ['languaje' => $languaje,
             'activo' => $activo
            ]);

    }

    /**
     * @Route("/{languaje}/contacto", name="ceco_contacto")
     */
    public function contactoAction($languaje='es', $activo='contacto')
    {
        return $this->render('Cecofersa/contacto.html.twig',
            ['languaje' => $languaje,
             'activo' => $activo
            ]);

    }
}
