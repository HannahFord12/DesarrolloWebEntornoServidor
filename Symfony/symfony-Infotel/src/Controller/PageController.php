<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('page/inicio.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    #[Route('/productos', name: 'productos')]
    public function productos(): Response
    {
        return $this->render('page/productos.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    #[Route('/contacto', name: 'contacto')]
    public function contacto(): Response
    {
        return $this->render('page/contacto.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }
}
