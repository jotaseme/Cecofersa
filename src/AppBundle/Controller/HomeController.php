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
     * @Route("/{languaje}/about", name="ceco_somos_en")
     * @Route("/{languaje}/somos", name="ceco_somos_pt")
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
     * @Route("/{languaje}/services", name="ceco_servicios_en")
     * @Route("/{languaje}/servicos", name="ceco_servicios_pt")
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
     * @Route("/{languaje}/brochures", name="ceco_folletos_en")
     * @Route("/{languaje}/folhetos", name="ceco_folletos_pt")
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
     * @Route("/{languaje}/products", name="ceco_productos_en")
     * @Route("/{languaje}/produtos", name="ceco_productos_pt")
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
     * @Route("/{languaje}/information", name="ceco_informacion_en")
     * @Route("/{languaje}/informacao", name="ceco_informacion_pt")
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
     * @Route("/{languaje}/members", name="ceco_asociados_en")
     * @Route("/{languaje}/associados", name="ceco_asociados_pt")
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
     * @Route("/{languaje}/contact", name="ceco_contacto_en")
     * @Route("/{languaje}/contato", name="ceco_contacto_pt")
     */
    public function contactoAction($languaje='es', $activo='contacto')
    {
        return $this->render('Cecofersa/contacto.html.twig',
            ['languaje' => $languaje,
             'activo' => $activo
            ]);

    }
}
