<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin/categories', name: 'app_categories')]
    public function categories(): Response
    {
        return $this->render('admin/categories.html.twig', []);
    }
}
