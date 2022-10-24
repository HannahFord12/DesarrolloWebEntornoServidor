<?php

namespace App\Controller;

use App\Entity\Telefonos;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TelefonosController extends AbstractController
{
    #[Route('/telefonos', name: 'app_telefonos')]
    public function index(): Response
    {
        return $this->render('telefonos/index.html.twig', [
            'controller_name' => 'TelefonosController',
        ]);
    }

    #[Route("/contacto/nuevo", name:"nuevo_contacto")]

    public function nuevo(ManagerRegistry $doctrine, Request $request){
        $telefono = new Telefonos();

        $formulario = $this->createForm(TelefonoType::class,$telefono);
            
        $formulario->handleRequest($request);

        if($formulario->isSubmitted() && $formulario-> isValid()){
            $telefono = $formulario-> getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($telefono);
            $entityManager ->flush();
            return $this->redirectToRoute('ficha_telefono',[
                "codigo" => $telefono->getId()
            ]);
        }

        return $this->render('nuevo.html.twig',array(
            'formulario'=>  $formulario->createView()
        ));
    }

    #[Route('/telefonos/insertar', name: 'insertar_telefono')]
    public function insertar(ManagerRegistry $doctrine){
        $entityManager = $doctrine->getManager();
        foreach ($this->telefonos as $c) {
            $telefono = new Telefonos();
            $telefono ->setMarca($c["marca"]);
            $telefono ->setModelo($c["modelo"]);
            $telefono ->setPrecio($c["precio"]);
            $telefono ->setProcesador($c["procesador"]);
            $telefono ->setRam($c["ram"]);
            $telefono ->setAlmacenamiento($c["almacenamiento"]);
            $entityManager ->persist($telefono);
        }
        try{
            //solo se necesitara hacer flush una vez y confirmara todas las operaciones pendientes
            $entityManager->flush();
            return new Response("Telefonos insertados ");
        }catch (\Exception $e){
            return new Response("Error al insertar objetos" . $e->getMessage());
        }
        
        
    }
}
